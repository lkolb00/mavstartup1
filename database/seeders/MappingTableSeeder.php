<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Map;
use App\Models\MapTable;
use Illuminate\Support\Facades\DB;

class MappingTableSeeder extends Seeder
{
    public function run()
    {
        // dynamic populating the filename on the basis of uploading files feature on UI
        if(isset($_SERVER['jobSeeding']) && $_SERVER['jobSeeding']) {
            // Seeding is done by uploading CSV file from UI
            $path = '/../../storage/app/uploads';
            $getfilename = DB::Table('map_tables')->where('table_name', '=', 'maps')
                ->orderBy('updated_at', 'DESC')->first()->csv_name;
        } else {
            $getfilename = DB::Table('map_tables')->where('table_name', '=', 'maps')->value('csv_name');
            if(!isset($_SERVER['partialseeding']) || !$_SERVER['partialseeding'])
                $path = '/../../resources/assets/csv/complete_csv';
            else
                $path = '/../../resources/assets/csv/partial_csv';
        }

        $file = __DIR__ . $path . DIRECTORY_SEPARATOR . $getfilename;

        $content = file($file);
        $array = array();
        for($i = 0; $i < count($content); $i++) {
            $line = explode(',', $content[$i]);
            for($j = 0; $j < count($line); $j++) {
                $array[$i][$j + 1] = $line[$j];
            }
        }
        DB::table('maps')->delete();
        foreach ($array as $value)
        {
            DB::table('maps')->insert([
                'column_header' => trim($value['1']),
                'csv_header'=> trim($value['2']),
                'table_name'=> trim($value['3']),
                'year'=> trim($value['4']),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ]);
        }
    }
}
