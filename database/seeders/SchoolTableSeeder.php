<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

//This file involves seeding of school table directly from CSV files
// All classes must inherit abstract class CsvDataSeeder to seed data

class SchoolTableSeeder extends CsvDataSeeder
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
            $whereClause = ['table_name' => 'schools', 'full' => true];
        } else {
            $whereClause = ['table_name' => 'schools', 'partial' => true];
        }
        $this->getfilename = DB::Table('map_tables')->where($whereClause)->pluck('csv_name');

        if(!isset($_SERVER['partialseeding']) || !$_SERVER['partialseeding'])
            $this->path = '/../../resources/assets/csv/complete_csv';
        else
            $this->path = '/../../resources/assets/csv/partial_csv';

        $this->table = 'schools';
    }

    public function run()
    {
        $schooltable = new SchoolTableSeeder();
        if(isset($_SERVER['jobSeeding']) && $_SERVER['jobSeeding']) {
            // Seeding is done by uploading CSV file from UI
            $this->path = '/../../storage/app/uploads';
            $currentCsvFile = DB::Table('map_tables')->where('table_name', '=', 'schools')
                ->orderBy('updated_at', 'DESC')->first()->csv_name;
            Log::info('SchoolTable.run: File name is '. $currentCsvFile);
            $this->getfilename = collect([$currentCsvFile]);
        }
        $schooltable->setTableName($this->table);
        $schooltable->setColumnMapping();

        foreach($this->getfilename as $file){

            $this->filename = __DIR__ . $this->path . DIRECTORY_SEPARATOR . $file;
            $schooltable->setFileName($this->filename);
            $schooltable->setYear($file);
            $schooltable->seedFromCSV($this->filename);
        }
    }

}
