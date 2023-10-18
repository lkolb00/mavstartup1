<?php

namespace Database\Seeders;

use App\Models\MapTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CreateMapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $dt = date_create();

        $map = MapTable::firstOrNew(['csv_name' => 'mapping.csv', 'table_name' => 'maps', 'year' => 0]);
        $data = array('csv_name' => 'mapping.csv', 'table_name' => 'maps', 'year' => 0, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
        (!$map->exists) ? $map->fill($data)->save() : $map->fill(Arr::except($data, ['created_at']))->save();

        $map = MapTable::firstOrNew(['csv_name' => 'schools_2016.csv', 'table_name' => 'schools', 'year' => 2016]);
        $data = array('csv_name' => 'schools_2016.csv', 'table_name' => 'schools', 'year' => 2016, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
        (!$map->exists) ? $map->fill($data)->save() : $map->fill(Arr::except($data, ['created_at']))->save();

        $map = MapTable::firstOrNew(['csv_name' => 'employees_2016.csv', 'table_name' => 'employees', 'year' => 2016]);
        $data = array('csv_name' => 'employees_2016.csv', 'table_name' => 'employees', 'year' => 2016, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
        (!$map->exists) ? $map->fill($data)->save() : $map->fill(Arr::except($data, ['created_at']))->save();

        $map = MapTable::firstOrNew(['csv_name' => 'student_2016.csv', 'table_name' => 'students', 'year' => 2016]);
        $data = array('csv_name' => 'student_2016.csv', 'table_name' => 'students', 'year' => 2016, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
        (!$map->exists) ? $map->fill($data)->save() : $map->fill(Arr::except($data, ['created_at']))->save();
//        $map = MapTable::firstOrNew(['csv_name' => 'F1.csv', 'table_name' => 'public_total_salary_wage_table', 'year' => 2016]);
//        $data = array('csv_name' => 'F1.csv', 'table_name' => 'public_total_salary_wage_table', 'year' => 2016,  'partial' => true,  'full' => true);
//        (!$map->exists) ? $map->fill($data)->save() : $map->fill(Arr::except($data, ['created_at']))->save();


         $map = MapTable::firstOrNew(['csv_name' => 'carnegie_2016.csv', 'table_name' => 'carnegie_classifications', 'year' => 2016]);
         $data = array('csv_name' => 'carnegie_2016.csv', 'table_name' => 'carnegie_classifications', 'year' => 2016,'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
         (!$map->exists) ? $map->fill($data)->save() : $map->fill(Arr::except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'employee_2015.csv', 'table_name' => 'employees', 'year' => 2015]);
//         $data = array('csv_name' => 'employee_2015.csv', 'table_name' => 'employees', 'year' => 2015,  'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();

//
//         $map = MapTable::firstOrNew(['csv_name' => 'finance_2015.csv', 'table_name' => 'finances', 'year' => 2015]);
//         $data = array('csv_name' => 'finance_2015.csv', 'table_name' => 'finances', 'year' => 2015, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'school_summary_2015.csv', 'table_name' => 'school_summary', 'year' => 2015]);
//         $data = array('csv_name' => 'school_summary_2015.csv', 'table_name' => 'school_summary', 'year' => 2015, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'defaultrate_final.csv', 'table_name' => 'defaultrates', 'year' => 0]);
//         $data = array('csv_name' => 'defaultrate_final.csv', 'table_name' => 'defaultrates', 'year' => 0, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'schools_2014.csv', 'table_name' => 'schools', 'year' => 2014]);
//         $data = array('csv_name' => 'schools_2014.csv', 'table_name' => 'schools', 'year' => 2014, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'carnegie_2014.csv', 'table_name' => 'carnegie_classifications', 'year' => 2014]);
//         $data = array('csv_name' => 'carnegie_2014.csv', 'table_name' => 'carnegie_classifications', 'year' => 2014,'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'employee_2014.csv', 'table_name' => 'employees', 'year' => 2014]);
//         $data = array('csv_name' => 'employee_2014.csv', 'table_name' => 'employees', 'year' => 2014,  'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'student_2014.csv', 'table_name' => 'students', 'year' => 2014]);
//         $data = array('csv_name' => 'student_2014.csv', 'table_name' => 'students', 'year' => 2014, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'finance_2014.csv', 'table_name' => 'finances', 'year' => 2014]);
//         $data = array('csv_name' => 'finance_2014.csv', 'table_name' => 'finances', 'year' => 2014, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'school_summary_2014.csv', 'table_name' => 'school_summary', 'year' => 2014]);
//         $data = array('csv_name' => 'school_summary_2014.csv', 'table_name' => 'school_summary', 'year' => 2014, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'schools_2013.csv', 'table_name' => 'schools', 'year' => 2013]);
//         $data = array('csv_name' => 'schools_2013.csv', 'table_name' => 'schools', 'year' => 2013, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'carnegie_2013.csv', 'table_name' => 'carnegie_classifications', 'year' => 2013]);
//         $data = array('csv_name' => 'carnegie_2013.csv', 'table_name' => 'carnegie_classifications', 'year' => 2013,'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'employee_2013.csv', 'table_name' => 'employees', 'year' => 2013]);
//         $data = array('csv_name' => 'employee_2013.csv', 'table_name' => 'employees', 'year' => 2013,  'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'student_2013.csv', 'table_name' => 'students', 'year' => 2013]);
//         $data = array('csv_name' => 'student_2013.csv', 'table_name' => 'students', 'year' => 2013, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'finance_2013.csv', 'table_name' => 'finances', 'year' => 2013]);
//         $data = array('csv_name' => 'finance_2013.csv', 'table_name' => 'finances', 'year' => 2013, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'school_summary_2013.csv', 'table_name' => 'school_summary', 'year' => 2013]);
//         $data = array('csv_name' => 'school_summary_2013.csv', 'table_name' => 'school_summary', 'year' => 2013, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => true,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'schools_2012.csv', 'table_name' => 'schools', 'year' => 2012]);
//         $data = array('csv_name' => 'schools_2012.csv', 'table_name' => 'schools', 'year' => 2012, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => false,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'carnegie_2012.csv', 'table_name' => 'carnegie_classifications', 'year' => 2012]);
//         $data = array('csv_name' => 'carnegie_2012.csv', 'table_name' => 'carnegie_classifications', 'year' => 2012,'created_at' => $dt, 'updated_at' => $dt,  'partial' => false,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'employee_2012.csv', 'table_name' => 'employees', 'year' => 2012]);
//         $data = array('csv_name' => 'employee_2012.csv', 'table_name' => 'employees', 'year' => 2012,  'created_at' => $dt, 'updated_at' => $dt,  'partial' => false,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'student_2012.csv', 'table_name' => 'students', 'year' => 2012]);
//         $data = array('csv_name' => 'student_2012.csv', 'table_name' => 'students', 'year' => 2012, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => false,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'finance_2012.csv', 'table_name' => 'finances', 'year' => 2012]);
//         $data = array('csv_name' => 'finance_2012.csv', 'table_name' => 'finances', 'year' => 2012, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => false,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
//
//         $map = MapTable::firstOrNew(['csv_name' => 'school_summary_2012.csv', 'table_name' => 'school_summary', 'year' => 2012]);
//         $data = array('csv_name' => 'school_summary_2012.csv', 'table_name' => 'school_summary', 'year' => 2012, 'created_at' => $dt, 'updated_at' => $dt,  'partial' => false,  'full' => true);
//         (!$map->exists) ? $map->fill($data)->save() : $map->fill(array_except($data, ['created_at']))->save();
    }
}
