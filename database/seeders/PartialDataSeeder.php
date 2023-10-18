<?php

namespace Database\Seeders;

class PartialDataSeeder extends CsvDataSeeder
{
    public $table;
    public $filename;
    public $getfilename;
    public $path;

    public function __construct()
    {
        $_SERVER['partialseeding']=true;
        $_SERVER['jobSeeding'] = false;
    }

    public function run()
    {
        $this->call(PbbtTableSeeder::class);
    }
}
