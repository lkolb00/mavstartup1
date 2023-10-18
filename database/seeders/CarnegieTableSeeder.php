<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

//This file involves seeding of carnegie table directly from CSV files
// All classes must inherit abstract class CsvDataSeeder to seed school_summary
Class CarnegieTableSeeder extends CsvDataSeeder
{
    public $table;
    public $filename;
    public $getfilename;
    public $path;

    public function __construct()
    {
        // dynamic populating the filename on the basis of uploading files feature on UI
        $whereClause = [];
        if(!isset($_SERVER['partialseeding']) || !$_SERVER['partialseeding']) {
            $whereClause = ['table_name' => 'carnegie_classifications', 'full' => true];
        } else {
            $whereClause = ['table_name' => 'carnegie_classifications', 'partial' => true];
        }
        $this->getfilename = DB::Table('map_tables')->where($whereClause)->pluck('csv_name');
        if(!isset($_SERVER['partialseeding']) || !$_SERVER['partialseeding'])
            $this->path = '/../../resources/assets/csv/complete_csv';
        else
            $this->path = '/../../resources/assets/csv/partial_csv';
        $this->table = 'carnegie_classifications';
    }

    public function run()
    {
        $cngtable = new CarnegieTableSeeder();
        if(isset($_SERVER['jobSeeding']) && $_SERVER['jobSeeding']) {
            // Seeding is done by uploading CSV file from UI
            $this->path = '/../../storage/app/uploads';
            $currentCsvFile = DB::Table('map_tables')->where('table_name', '=', 'carnegie_classifications')
                ->orderBy('updated_at', 'DESC')->first()->csv_name;
            Log::info('CarnegieTable.run: File name is '. $currentCsvFile);
            $this->getfilename = collect([$currentCsvFile]);
        }
        $cngtable->setTableName($this->table);
        $cngtable->setColumnMapping();

        foreach($this->getfilename as $file) {

            $this->filename = __DIR__ . $this->path . DIRECTORY_SEPARATOR . $file;
            $cngtable->setFileName($this->filename);
            $cngtable->setYear($file);
            $tempFilename = basename($this->filename);
            $year = DB::Table('map_tables')->where('csv_name', '=', $tempFilename)->value('year');
            Log::info('CarnegieTable.run: File year is '. $year);
            $cngtable->resetTable($year);
            $cngtable->seedFromCSV($this->filename);
        }
    }
}
