<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Affiliation;
use Illuminate\Support\Arr;

class AffiliationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $dt = date_create();
        $sys = 'System';

        $record = Affiliation::firstOrNew(['name' => 'Higher Education']);
        $data = ['name' => 'Higher Education', 'description' => 'Higher Education such as public and private Universities or Community Colleges ',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = Affiliation::firstOrNew(['name' => 'Journalism']);
        $data = ['name' => 'Journalism', 'description' => 'Journalist working for any News organization',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = Affiliation::firstOrNew(['name' => 'Policy Analyst']);
        $data = ['name' => 'Policy Analyst', 'description' => 'Policy Analyst working for State/Local government or other agencies',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = Affiliation::firstOrNew(['name' => 'Government']);
        $data = ['name' => 'Government', 'description' => 'Government or Government Agency',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = Affiliation::firstOrNew(['name' => 'Accreditation']);
        $data = ['name' => 'Accreditation', 'description' => 'Accreditation organization for Higher Education such as ABET, etc',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();
    }
}
