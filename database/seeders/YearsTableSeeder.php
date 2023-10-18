<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('years')->delete();

        Year::create([  'year' => '2012', 'active'=> '1', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2013', 'active'=> '1',  'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2014', 'active'=> '1',  'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2015', 'active'=> '1', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2016', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2017', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2018', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2019', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2020', 'created_at' => date_create(), 'updated_at' => date_create()]);
        Year::create([  'year' => '2021', 'created_at' => date_create(), 'updated_at' => date_create()]);
    }
}
