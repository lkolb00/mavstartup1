<?php

// This file involves the seeding of all tables directly from CSV files
// All seeder classes must inherit this abstract class CsvDataSeeder to seed school_summary from CSV files
namespace Database\Seeders;

use App\Models\MapTable;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;



/*
 * This function retrieves school_summary from CSV files
 * It is invoked by all Model Seeder classes and
 * seeds the corresponding tables for those models
 * $table                   Sets the Table Name
 * $filename                Sets the file name of the CSV
 * $offset_rows             Denotes the rows to be offset from the start of CSV file
 * $insert_chunk_size       Inserts school_summary to DB from array once this value is reached
 * $mapping                 Creates a map of DB column names
 */

abstract class CsvDataSeeder extends Seeder
{
    public $table;
    public $filename;
    public $insert_chunk_size = 1;
    public $csv_delimiter = ',';
    public $offset_rows = 1;
    public $file;
    public $year;
    //Array to store Database column names
    public $mapping = [];

    public function resetTable($year = 0)
    {
        //If this is an entire new seed, we need to reset table
        if ($year === 0) {
            //If files are not based on year, remove all entries from table
            // This is applicable for Default Rate table only
            $completeData = DB::table($this->table)->get();
            if(sizeof($completeData)) {
                $archivedTableName = 'archive_' . $this->table;
                $completeData = json_decode(json_encode($completeData), true);
                $chunkedCompleteData = array_chunk($completeData, 1000, true);
                foreach ($chunkedCompleteData as $newChunkCompleteData) {
                    DB::table($archivedTableName)->insert($newChunkCompleteData);
                }
            }
            DB::table($this->table)->truncate();
        } else {
            //Otherwise, store the old school_summary in archive tables and delete
            // the entries for that year in the table
            $yearData = DB::table($this->table)->where('year', '=', $year)->get();
            if (sizeof($yearData)) {
                $archivedTableName = 'archive_' . $this->table;
                Log::info('CsvDataSeeder.resetTable: Archived Table is '. $archivedTableName);
                $yearData = json_decode(json_encode($yearData), true);
                $chunkedYearData = array_chunk($yearData, 1000, true);
                foreach ($chunkedYearData as $newChunkYearData) {
                    Log::info('CsvDataSeeder.resetTable: Inserting school_summary to archive table'. $archivedTableName);
                    DB::table($archivedTableName)->insert($newChunkYearData);
                }
                DB::table($this->table)->where('year', '=', $year)->delete();
            }
        }
    }

    public function setTableName($tablename)
    {
        $this->table = $tablename;
    }

    public function setFileName($filename)
    {
        Log::info('CsvDataSeeder.setFileName: File name is '. $filename);
        $this->filename = $filename;
    }

    public function setColumnMapping()
    {
        //Retrieve the column names of the table and store them in the array
        $columns = Schema::getColumnListing($this->table);
        $i = 1;
        while ($i < (sizeof($columns) - 1)) {
            $this->mapping[] = $columns[$i];
            $i++;
        }
    }

    public function setYear($file)
    {
        $year = DB::Table('map_tables')->where('csv_name', '=', $file)->value('year');
        Log::info('CsvDataSeeder.setYear: File year is '. $year);
        $this->year = $year;
    }

    public function openCSV($filename)
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            Log::error("CSV insert failed" . $filename . "does not exist or is not readable");
        }
        $handle = fopen($filename, 'r');
        return $handle;
    }

    public function seedFromCSV($filename, $deliminator = ','): array
    {
        ini_set('auto_detect_line_endings', TRUE);
        $handle = $this->openCSV($filename);
        // CSV doesn't exist or couldn't be read from.
        if ($handle === FALSE) {
            Log::info('CsvDataSeeder.seedFromCSV File ' . $filename . ' could not be opened is ');
            return [];
        }
        $header = NULL;
        $row_count = 0;
        $data = [];
        // Array to store CSV Header column names
        $Csv_header_array = [];
        $mapping = $this->mapping ?: [];
        $csvDbColumnMap = [];
        //Check if there is a mapping file for the current year, otherwise use previous year's mapping
        $mappingYear = $this->year;
        $mapExists = DB::Table('maps')->where([
                ['table_name', '=', $this->table], ['year', '=', $mappingYear],
            ])->first();
        if(!$mapExists) {
            //Get the latest mapping year from the database
            $mappingYear =  DB::Table('maps')->where('table_name', '=', $this->table)
                ->orderBy('year', 'DESC')->first()->year;
            Log::info('CsvDataSeeder.seedFromCSV Using mapping year: ' . $mappingYear);
        }
        //Create a key:value pair of Db column name and csv file header name
        foreach ($mapping as $dbCol) {
            $csvColumnName = DB::Table('maps')->where('year', '=', $mappingYear)
                ->where('column_header', '=', $dbCol)->value('csv_header');
            $csvDbColumnMap [$dbCol] = $csvColumnName;
        }
        //Create a key:value pair of school ID and school Unit ID
        $schoolIndexUnitIdMap = School::pluck('id', 'unitid');
        //Create a key:value pair of year and csv file name
        $yearMap = MapTable::pluck('year', 'csv_name');
        $offset = $this->offset_rows;
        while (($row = fgetcsv($handle, 0, $deliminator)) !== FALSE) {
            //Offset the specified number of rows
            while ($offset > 0) {
                //If the row being read is the first, store the CSV header names in the array
                $index = 0;
                while ($index < sizeof($row)) {
                    array_push($Csv_header_array, $row[$index]);
                    $index++;
                }
                $offset--;
                continue 2;
            }
            ini_set('auto_detect_line_endings', FALSE);
            //No mapping specified - grab the first CSV row and use it
            if (!$mapping) {
                $mapping = $row;
            } else {
                //Array to store CSV column headers
                $source_array = $this->readRow($row, $Csv_header_array);
                //Create a map of database column names to the corresponding values from current CSV file
                $row = $this->fillMapArray($source_array, $csvDbColumnMap, $schoolIndexUnitIdMap, $yearMap);
                //Insert only non-empty rows from the csv file
                if (!$row)
                    continue;
                $data[$row_count] = $row;
                //Chunk size reached, insert school_summary
                if (++$row_count == $this->insert_chunk_size) {
                    $this->insert($data);
                    $row_count = 0;
                    //Clear the school_summary array explicitly to avoid duplicate inserts
                    $data = array();
                }
            }
        }
        //Insert any leftover rows
        if (count($data))
            $this->insert($data);
        fclose($handle);
        return $data;
    }

    public function readRow(array $row, array $Csv_header_array): array
    {
        //Read the values of the current CSV file column headers and store them in an array
        $source_array = [];
        foreach ($Csv_header_array as $index => $csvCol) {
            if (!isset($row[$index]) || $row[$index] === '') {
                $source_array[$csvCol] = NULL;
            } else {
                $source_array[$csvCol] = $row[$index];
            }
        }
        return $source_array;
    }

    public function fillMapArray($source_array, $csvDbColumnMap, $schoolIndexUnitIdMap, $yearMap): array
    {
        $row_values = [];
        $no_of_columns_to_fill = sizeof($source_array);
        //Create a key : value pair between DB column names and current CSV file school_summary
        foreach ($csvDbColumnMap as $dbCol => $csvHeader) {
            if ($dbCol === 'year') {
                // Fetch the year value on the basis of uploaded file
                // This is applicable for summary tables with "year" as a key attribute
                $tempFilename = basename($this->filename);
                $yearColumn = $yearMap[$tempFilename];
                Log::info('File name is '. $tempFilename . ' and file year is ' . $yearColumn);
                if ($yearColumn !== 0) {
                    $row_values[$dbCol] = $yearColumn;
                } else {
                    $row_values[$dbCol] = $source_array[$csvHeader];
                }
                $no_of_columns_to_fill--;
            } else {
                // Mapping of "school_id" is done with "unitid" for summary tables
                // So, fetch the "school_id" key attribute value corresponding to the "unitid" value from schools table
                if ($dbCol === 'school_id') {
                    if ($csvHeader != null) {
                        $temp = $schoolIndexUnitIdMap[$source_array[$csvHeader]];
                        $row_values[$dbCol] = $temp;
                        $no_of_columns_to_fill--;
                    }
                } else {
                    if ($no_of_columns_to_fill > 0) {
                        if ($csvHeader === NULL) {
                            $no_of_columns_to_fill--;
                        } else {
                            $row_values[$dbCol] = $source_array[$csvHeader];
                            $no_of_columns_to_fill--;
                        }
                    }
                }
            }
        }
        return $row_values;
    }

    public function insert(array $seedData): bool
    {
        //In case of schools table, create or update based on "unitid"
        if ($this->table === "schools") {
            try {
                for ($i = 0; $i < count($seedData); $i++) {
                    School::updateOrCreate(['unitid' => $seedData[$i]['unitid']], $seedData[$i]);
                }
            } catch (\Exception $e) {
                Log::error("CSV insert failed: " . $e->getMessage() . " - CSV " . $this->filename);
                return FALSE;
            }
        } else {
            //For all other tables, Data for the year is already deleted, so insert directly
            try {
                DB::table($this->table)->insert($seedData);
            } catch (\Exception $e) {
                Log::error("CSV insert failed: " . $e->getMessage() . " - CSV " . $this->filename);
                return FALSE;
            }
        }
        return TRUE;
    }
}
