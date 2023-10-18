<?php

namespace Database\Seeders;

use App\Utility\Memory;
use App\Utility\StopWatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PbbtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Memory::dump_usage(true);
        ini_set("memory_limit","512M");

        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('      Start: Seeding Pbbt Users, Attributes and Mapping Tables          !');
        $this->command->info('------------------------------------------------------------------------!');
        $this->call(CreateMapTableSeeder::class);

        // Seed the Instruction Category, State Abbreviations and Carnegie Classifications Tables
//        $this->call(InstitutionCategorySeeder::class);
//        $this->call(StateAbbreviationSeeder::class);
//        $this->call(CarnegieClassificationTypeSeeder::class);

        //Seed Variable Definitions, Years and Mapping Tables
//        $this->call(VariableDefinitionTableSeeder::class);
        $this->call(YearsTableSeeder::class);
        $this->call(MappingTableSeeder::class);

        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('      End: Seeding Pbbt Users, Attributes and Mapping Tables            !');
        $this->command->info('------------------------------------------------------------------------!');

        $this->command->info('------------------------------------------------------------------------!');
        $this->command->info('      Start: Seeding Schools, Carnegie and SchoolSummary Tables         !');
        $this->command->info('------------------------------------------------------------------------!');
        Memory::dump_usage(true);
        StopWatch::start('main-seeding');

        $this->call(SchoolTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(CarnegieTableSeeder::class);


    }
}
