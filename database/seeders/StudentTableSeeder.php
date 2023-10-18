<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

Class StudentTableSeeder extends CsvDataSeeder
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
            $whereClause = ['table_name' => 'students', 'full' => true];
        } else {
            $whereClause = ['table_name' => 'students', 'partial' => true];
        }
        $this->getfilename = DB::Table('map_tables')->where($whereClause)->pluck('csv_name');
        if(!isset($_SERVER['partialseeding']) || !$_SERVER['partialseeding'])
            $this->path = '/../../resources/assets/csv/complete_csv';
        else
            $this->path = '/../../resources/assets/csv/partial_csv';
        $this->table = 'students';
    }

    public function run()
    {
        $studenttable = new StudentTableSeeder();
        if(isset($_SERVER['jobSeeding']) && $_SERVER['jobSeeding']) {
            // Seeding is done by uploading CSV file from UI
            $this->path = '/../../storage/app/uploads';
            $currentCsvFile = DB::Table('map_tables')->where('table_name', '=', 'students')
                ->orderBy('updated_at', 'DESC')->first()->csv_name;
            Log::info('StudentTable.run: File name is '. $currentCsvFile);
            $this->getfilename = collect([$currentCsvFile]);
        }
        $studenttable->setTableName($this->table);
        $studenttable->setColumnMapping();

        foreach($this->getfilename as $file){

            $this->filename = __DIR__ . $this->path . DIRECTORY_SEPARATOR . $file;
            $studenttable->setFileName($this->filename);
            $studenttable->setYear($file);
            $tempFilename = basename($this->filename);
            $year = DB::Table('map_tables')->where('csv_name', '=', $tempFilename)->value('year');
            Log::info('StudentTable.run: File year is '. $year);
            $studenttable->resetTable($year);
            $studenttable->seedFromCSV($this->filename);
        }
    }
}
