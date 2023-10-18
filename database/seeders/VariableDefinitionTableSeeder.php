<?php
/**
 * Variable Definition Seeder
 *
 * @category   Database
 * @package    Seeder
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2018
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VariableDefinition;
use Illuminate\Support\Arr;

class VariableDefinitionTableSeeder extends Seeder
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

        $record = VariableDefinition::firstOrNew(['name' => 'Admin and Professional Staff']);
        $data = ['name' => 'Admin and Professional Staff',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Total head count of full-time administrative and professional staff including management occupations; business and financial operations occupations; computer, engineering, and science occupations; community service, legal, arts and media occupations; healthcare practitioners and technical occupations; and office & administrative support.',
            'details'=>'IPEDS Employees by Assigned Position (EAP)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Admin and Professional Staff per Thousand Students']);
        $data = ['name' => 'Admin and Professional Staff per Thousand Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Institutional administrative staff size defined as Admin and Professional Staff * (1,000 / total student 12-month enrollment).',
            'details'=>'IPEDS Employees by Assigned Position (EAP) and IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Admin and Professional Staff Salary per Million']);
        $data = ['name' => 'Admin and Professional Staff Salary per Million',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Computed full-time admin and professional staff salary defined as admin and professional staff salary and wages * (1,000,000 / total salary and wages expenses). Admin and professional staff includes management occupations; business and financial operations occupations; computer, engineering, and science occupations; community service, legal, arts and media occupations; healthcare practitioners and technical occupations; and office & administrative support.',
            'details'=>'IPEDS Instructional Staff Salaries - Non-Instructional Staff (SAL_NIS) and IPEDS Finance (F1A, F2, F3)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Associate Degree & Certificate 3-Yr Grad Rate']);
        $data  = [ 'name' => 'Associate Degree & Certificate 3-Yr Grad Rate',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Number of full-time, degree-seeking Associate\'s and certificate completers in 3-years or less / adjusted cohort. 2-year institutions only.',
            'details'=>'IPEDS Graduation Rates (GR)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Average SCH per Student per AY (grad)']);
        $data  = [ 'name' => 'Average SCH per Student per AY (grad)',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Average graduate student credit hour (SCH) per student for academic year defined as total 12-month enrollment graduate instructional activity credit hours / 12-month enrollment graduate student head count.',
            'details'=>'IPEDS 12-Month Enrollment (EFIA and EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Average SCH per Student per AY (undergrad)']);
        $data  = [ 'name' => 'Average SCH per Student per AY (undergrad)',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Average undergraduate student credit hour (SCH) per student for academic year defined as total 12-month enrollment undergraduate instructional activity credit hours / 12-month enrollment undergraduate student head count.',
            'details'=>'IPEDS 12-Month Enrollment (EFIA and EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Bachelor Degree 4-Yr Grad Rate']);
        $data  = [ 'name' => 'Bachelor Degree 4-Yr Grad Rate',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Number of full-time, degree-seeking Bachelors or equiv completers in 4-years or less / adjusted cohort. 4-year institutions only.',
            'details'=>'IPEDS Graduation Rates (GR)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Bachelor Degree 6-Yr Grad Rate']);
        $data  = [ 'name' => 'Bachelor Degree 6-Yr Grad Rate',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Number of full-time, degree-seeking Bachelors or equiv completers in 6-years or less / adjusted cohort. 4-year institutions only.',
            'details'=>'IPEDS Graduation Rates (GR)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Graduate Certificates per Hundred Graduate Students']);
        $data  = [ 'name' => 'Graduate Certificates per Hundred Graduate Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => '(Graduate certificates awarded * 100) / 12-month enrollment graduate student headcount. Certificates awarded include first and second majors.',
            'details'=>'IPEDS Completions (C) and IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Graduate Degrees per Hundred Graduate Students']);
        $data  = [ 'name' => 'Graduate Degrees per Hundred Graduate Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => '(Sum of Masters degrees awarded and doctorate degress awarded * 100) / 12-month enrollment graduate student head count. Degrees awarded include first and second majors.',
            'details'=>'IPEDS Completions (C) and IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Instructor Salary per Million']);
        $data  = [ 'name' => 'Instructor Salary per Million',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Computed full-time instructional staff salary  per million defined as (instructional staff salary and wages * 1,000,000) / total salary and wages expenses.',
            'details'=>'IPEDS Instructional Staff Salaries - Instructional Staff (SAL_IS) and IPEDS Finance (F1A, F2, F3))',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Instructors and Staff']);
        $data  = [ 'name' => 'Instructors and Staff',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'The sum of Instructional Staff, Admin and Professional Staff, Non-Instructional Academic Staff, and Non-Admin Trade and Services Staff.',
            'details'=>'IPEDS Employees by Assigned Position (EAP)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Instruction Staff']);
        $data  = [ 'name' => 'Instruction Staff',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Total head count of full-time instructional staff.',
            'details'=>'IPEDS Employees by Assigned Position (EAP)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Instructors per Thousand Students']);
        $data  = [ 'name' => 'Instructors per Thousand Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Institutional instructor size defined as (Instructional Staff * 1,000) / total student 12-month enrollment.',
            'details'=>'IPEDS Employees by Assigned Position (EAP) and IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Loan Default Rate']);
        $data  = [ 'name' => 'Loan Default Rate',
            'datasource' => 'Department of Education (DoE) Federal Student Aid',
            'description' => 'Loan default rate for students who entered repayment in the given year. Default is calculated within 3 years of entering repayment.',
            'details'=>'Official Cohort Default Rates for Schools',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Non-Admin Trade and Services Staff']);
        $data  = [ 'name' => 'Non-Admin Trade and Services Staff',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Total head count of full-time non-admin trade and service staff including service; sales and related; natural resources, construction, and maintenance; production, transportation, and material moving.',
            'details'=>'IPEDS Employees by Assigned Position (EAP)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Non-Admin Trade and Services Staff per Thousand Students']);
        $data  = [ 'name' => 'Non-Admin Trade and Services Staff per Thousand Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Institutional non-admin trade and services staff size defined as (Non-Admin Trade and Services Staff * 1,000) / total student 12-month enrollment.',
            'details'=>'IPEDS Employees by Assigned Position (EAP) and IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Non-Admin Trade Services Staff Salary per Million']);
        $data  = [ 'name' => 'Non-Admin Trade Services Staff Salary per Million',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Computed full time non-admin trade service staff salary defined as (non-admin trade service staff salary and wages * 1,000,000) / total salary and wages expenses. Non-admin trade and service staff includes service; sales and related; natural resources, construction, and maintenance; production, transportation, and material moving.',
            'details'=>'IPEDS Instructional Staff Salaries - Non-Instructional Staff (SAL_NIS) and IPEDS Finance (F1A, F2, F3)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Non-Instruction Academic Staff per Thousand Students']);
        $data  = [ 'name' => 'Non-Instruction Academic Staff per Thousand Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Institutional non-instructional staff size defined as (Non-Instruction Academic Staff * 1,000) / total student 12-month enrollment.',
            'details'=>'IPEDS Employees by Assigned Position (EAP) and IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Non-Instructional Academic Staff']);
        $data  = [ 'name' => 'Non-Instructional Academic Staff',
            'datasource' => 'Department of Education (DoE) Federal Student Aid',
            'description' => 'Total head count of full-time non-instructional academic staff including research, public service, librarians, curators, archivists, academic affairs, and other education services.',
            'details'=>'IPEDS Employees by Assigned Position (EAP)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Non-Instructional Academic Staff Salary per Million']);
        $data  = [ 'name' => 'Non-Instructional Academic Staff Salary per Million',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Computed full-time non-instructional academic staff salary defined as (non-instructional academic staff salary and wages * 1,000,000) / total salary and wages expenses. Non-instructional staff includes research, public service, librarians, curators, archivists, academic affairs, and other education services.',
            'details'=>'IPEDS Instructional Staff Salaries - Non-Instructional Staff (SAL_NIS) and IPEDS Finance (F1A, F2, F3)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Total Student Headcount']);
        $data  = [ 'name' => 'Total Student Headcount',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Unduplicated head count of students enrolled over a 12-month period for both undergraduate and graduate levels. Because this enrollment measure encompasses an entire year, it provides a more complete picture of the number of students these schools serve.',
            'details'=>'IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Undergrad Certificate per Thousand Undergrad Students']);
        $data  = [ 'name' => 'Undergrad Certificate per Thousand Undergrad Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => '(Undergraduate certificates awarded * 1,000) / 12-month enrollment undergraduate student headcount. Certificates awarded include first and second majors.',
            'details'=>'IPEDS Completions (C) and IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Undergrad Degrees per Thousand Undergrad Students']);
        $data  = [ 'name' => 'Undergrad Degrees per Thousand Undergrad Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => '(Sum of Bachelor degrees awarded and associated degrees awarded * 1,000) / 12-month enrollment undergraduate student headcount. Degrees awarded include first and second majors.',
            'details'=>'IPEDS Completions (C) and IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Undergraduate Students per Thousand Students']);
        $data  = [ 'name' => 'Undergraduate Students per Thousand Students',
            'datasource' => 'Department of Education (DoE) Federal Student Aid',
            'description' => 'Institutional student size defined as (total head count of undergraduate students * 1,000) / total student 12-month enrollment.',
            'details'=>'IPEDS 12-Month Enrollment (EFFY)',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Students']);
        $data  = [ 'name' => 'Students',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Total number of students (Undergraduate and Graduate).',
            'details'=>'',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Other Staff Salary and Wages']);
        $data  = [ 'name' => 'Other Staff Salary and Wages',
            'datasource' => 'Integrated Postsecondary Education Data System (IPEDS)',
            'description' => 'Total Salary and Wages – (Instruction Salary and Wages + Admin and Prof Staff Salary and Wages + Non-Instruction Academic Staff Salary and Wages +Non-Admin Trade and Service Staff Salary and Wages )',
            'details'=>'Not used in tool, but used to calculate  "other staff salary per million"',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

        $record = VariableDefinition::firstOrNew(['name' => 'Other Staff Salary per Million']);
        $data  = [ 'name' => 'Other Staff Salary per Million',
            'datasource' => 'Used in Resource table',
            'description' => 'Other Staff Salary and Wages * 1,000,000/Total Salary and Wages',
            'details'=>'',
            'created_by' => $sys, 'updated_by' => $sys, 'created_at' => $dt, 'updated_at' => $dt, ];
        (! $record->exists) ? $record->fill($data)->save() : $record->fill(Arr::except($data, ['created_at']))->save();

    }
}
