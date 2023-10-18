<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Affiliation;
use Illuminate\Support\Arr;

class BaseDataTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('--------------------------------------------------------------------------------');
        $this->command->info('                      Start: Seeding Base Data Tables                           ');
        $this->command->info('--------------------------------------------------------------------------------');

        $this->call(AffiliationsTableSeeder::class);
        $this->call(VariableDefinitionTableSeeder::class);

        $this->command->info('--------------------------------------------------------------------------------');
        $this->command->info('                      End: Seeding Base Data Tables                           ');
        $this->command->info('--------------------------------------------------------------------------------');
    }
}
