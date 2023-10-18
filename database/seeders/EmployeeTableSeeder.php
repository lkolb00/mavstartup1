<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

//This file involves seeding of employee table directly from CSV files
// All classes must inherit abstract class CsvDataSeeder to seed data

class EmployeeTableSeeder extends CsvDataSeeder
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
            $whereClause = ['table_name' => 'employees', 'full' => true];
        } else {
            $whereClause = ['table_name' => 'employees', 'partial' => true];
        }
        $this->getfilename = DB::Table('map_tables')->where($whereClause)->pluck('csv_name');
        if(!isset($_SERVER['partialseeding']) || !$_SERVER['partialseeding'])
            $this->path = '/../../resources/assets/csv/complete_csv';
        else
            $this->path = '/../../resources/assets/csv/partial_csv';
        $this->table = 'employees';
    }

    public function run()
    {
        $employeetable = new EmployeeTableSeeder();
        if(isset($_SERVER['jobSeeding']) && $_SERVER['jobSeeding']) {
            // Seeding is done by uploading CSV file from UI
            $this->path = '/../../storage/app/uploads';
            $currentCsvFile = DB::Table('map_tables')->where('table_name', '=', 'employees')
                ->orderBy('updated_at', 'DESC')->first()->csv_name;
            Log::info('EmployeeTable.run: File name is '. $currentCsvFile);
            $this->getfilename = collect([$currentCsvFile]);
        }
        $employeetable->setTableName($this->table);
        $employeetable->setColumnMapping();

        foreach($this->getfilename as $file){

            $this->filename = __DIR__ . $this->path . DIRECTORY_SEPARATOR . $file;
            $employeetable->setFileName($this->filename);
            $employeetable->setYear($file);
            $tempFilename = basename($this->filename);
            $year = DB::Table('map_tables')->where('csv_name', '=', $tempFilename)->value('year');
            Log::info('EmployeeTable.run: File year is '. $year);
            $employeetable->resetTable($year);
            $employeetable->seedFromCSV($this->filename);
        }
    }
}
