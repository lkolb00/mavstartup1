<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creates schools table
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->integer('unitid')->unique();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->char('zip',10)->nullable();
            $table->integer('fips_state_code')->nullable();
            $table->integer('geo_location')->nullable();
            $table->string('admin_name')->nullable();
            $table->string('admin_title')->nullable();
            $table->string('telephone_number',25)->nullable();
            $table->integer('emp_id')->nullable();
            $table->integer('opeid')->unsigned();
            $table->integer('ope_flag')->nullable();
            $table->string('school_url')->nullable();
            $table->string('admission_url')->nullable();
            $table->string('finance_url')->nullable();
            $table->string('online_app_url')->nullable();
            $table->string('netprice_calcurl')->nullable();
            $table->integer('sector')->nullable();
            $table->integer('institution_level')->nullable();
            $table->integer('institution_control')->nullable();
            $table->integer('highestlevel_offering')->nullable();
            $table->integer('ug_offering')->nullable();
            $table->integer('grad_offering')->nullable();
            $table->integer('highestdegree_offered')->nullable();
            $table->integer('degreegranting_status')->nullable();
            $table->integer('historical_blackCollege')->nullable();
            $table->integer('hospital')->nullable();
            $table->integer('grant_medicaldegree')->nullable();
            $table->integer('tribal_college')->nullable();
            $table->integer('degree_urbanization')->nullable();
            $table->integer('open_public')->nullable();
            $table->integer('mergedschool_unitid')->nullable();
            $table->char('status',3)->nullable();
            $table->integer('year_deletion_ipeds')->nullable();
            $table->string('closed_date')->nullable();
            $table->integer('current_year_active')->nullable();
            $table->integer('postsec_indicator')->nullable();
            $table->integer('postsec_inst_indicator')->nullable();
            $table->integer('postsectitle_instindicator')->nullable();
            $table->integer('reporting_method')->nullable();
            $table->text('institutename_alias')->nullable();
            $table->integer('institute_category')->nullable();
            $table->integer('landgrand_institution')->nullable();
            $table->integer('institute_sizecategory')->nullable();
            $table->integer('cbsa')->nullable();
            $table->integer('cbsa_type')->nullable();
            $table->integer('combinedstasticalarea')->nullable();
            $table->integer('newengland_citytownarea')->nullable();
            $table->integer('multi_inst')->nullable();
            $table->string('multi_inst_name')->nullable();
            $table->integer('fips_countycode')->nullable();
            $table->string('county_name')->nullable();
            $table->integer('cogressional_distcode')->nullable();
            $table->double('geo_longitude', 6, 3)->nullable();
            $table->double('geo_latitude', 6, 3)->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

       //Creates peer groups table
        Schema::create('peergroups', function (Blueprint $table) {
            $table->increments('peergroup_id');
            $table->integer('user_id')->unsigned();
            $table->string('peergroup_name')->nullable();
            $table->enum('private_public_flag', ['Private', 'Public']);
            $table->string('description')->nullable(); //Added May 27
            $table->boolean('default')->default(false);
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        //creating a pivot table --> peergroups, schools -> peergroup_school
        Schema::create('peergroup_school', function (Blueprint $table) {
            $table->id();
            $table->integer('peergroup_id')->unsigned()->index();
            $table->integer('school_id')->unsigned()->index();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('peergroup_id')->references('peergroup_id')->on('peergroups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
        });

        //Creates jobs table
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue');
            $table->longText('payload');
            $table->tinyInteger('attempts')->unsigned();
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
            $table->index(['queue', 'reserved_at']);
        });

//        //Create table for associating roles to users (Many-to-Many)
//        Schema::create('role_user', function (Blueprint $table) {
//            $table->integer('user_id')->unsigned();
//            $table->integer('role_id')->unsigned();
//            $table->string('created_by')->default('System');
//            $table->string('updated_by')->default('System');
//            $table->timestamps();
//            $table->softDeletes();
//
//            $table->primary(['user_id', 'role_id']);
//            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
//            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
//        });
//
        //Creates map_tables - uses filename and year for DB seeding
        Schema::create('map_tables', function (Blueprint $table) {
            $table->id();
            $table->string('csv_name',100);
            $table->string('table_name',40);
            $table->integer('year');
            $table->boolean('partial');
            $table->boolean('full');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['table_name','year']);
        });

        //Creates maps table
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('column_header');
            $table->string('csv_header')->nullable();
            $table->string('table_name')->nullable();
            $table->string('year')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        //Creates user_comments table
        Schema::create('user_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('is_active')->default(0);
            $table->string('author');
            $table->string('email');
            $table->text('comment_text');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        //Creates_reply comments table
        Schema::create('reply_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_comment_id')->index();
            $table->integer('is_active')->default(1);
            $table->string('author');
            $table->string('email');
            $table->text('comment_text');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_comment_id')->references('id')->on('user_comments')->onDelete('cascade');
        });

        //Creates institution_categorys table
        Schema::create('institution_categorys', function(Blueprint $table){
            $table->string('id');
            $table->string('description');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        //Creates state_abbreviations table
        Schema::create('state_abbreviations', function(Blueprint $table)
        {
            $table->string('id');
            $table->string('description');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        //Creates employees table
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->index();
            $table->integer('year')->index();
            $table->integer('inst_salary_academic_rank')->nullable();
            $table->integer('inst_salary_salaryoutlaytotal')->nullable();
            $table->integer('admin_profstaff_management')->nullable();
            $table->integer('admin_profstaff_business')->nullable();
            $table->integer('admin_profstaff_comp')->nullable();
            $table->integer('admin_profstaff_comunityservice')->nullable();
            $table->integer('admin_profstaff_healthcare')->nullable();
            $table->integer('admin_profstaff_ofcadmin')->nullable();
            $table->integer('nonadmin_servicestaffsalary_service_outlay')->nullable();
            $table->integer('nonadmin_servicestaffsalary_sales_outlay')->nullable();
            $table->integer('non_instn_acad_staff_library')->nullable();
            $table->integer('instruction_staff')->nullable();
            $table->integer('non_admin_service_staff_service')->nullable();
            $table->integer('non_admin_service_staff_sales')->nullable();
            $table->integer('non_admin_service_staff_resource')->nullable();
            $table->integer('non_admin_service_staff_prod')->nullable();
            $table->integer('non_inst_acad_staff_salary_research_outlay')->nullable();
            $table->integer('non_inst_acad_staff_salary_pubservice_outlay')->nullable();
            $table->integer('non_inst_acad_staff_salary_other_outlay')->nullable();
            $table->integer('admin_profstaff_salary_mgmt_outlay')->nullable();
            $table->integer('admin_profstaff_salary_business_outlay')->nullable();
            $table->integer('admin_profstaff_salary_compeng_outlay')->nullable();
            $table->integer('admin_profstaff_salary_community_outlay')->nullable();
            $table->integer('admin_profstaff_salary_technical_outlay')->nullable();
            $table->integer('admin_profstaff_salary_ofcadmin_outlay')->nullable();
            $table->integer('nonadmin_servicestaffsalary_construction_outlay')->nullable();
            $table->integer('nonadmin_servicestaffsalary_production_outlay')->nullable();
            $table->integer('EAPCAT')->nullable();
            $table->integer('instructors_per_thousand_student')->nullable();
            $table->integer('admin_professional_staff')->nullable();
            $table->integer('admin_professionalstaff_perthousandstudent')->nullable();
            $table->integer('noninstruction_academicstaff')->nullable();
            $table->integer('noninstruction_academicstaff_perthousandstudent')->nullable();
            $table->integer('nonadmin_trade_servicestaff')->nullable();
            $table->integer('nonadmin_tradeservicestaff_perthousandstudent')->nullable();
            $table->integer('all_instructors_staff')->nullable();
            $table->integer('instructor_salarypermillion')->nullable();
            $table->integer('adminprofessionalstaff_salarypermillion')->nullable();
            $table->integer('noninstruction_academicstaff_salarypermillion')->nullable();
            $table->integer('nonadmin_tradeservicestaff_salarypermillion')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'year']);
            $table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
        });

        //Creates students table
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->index();
            $table->integer('year')->index();
            $table->integer('total_studentcount_1')->nullable();
            $table->integer('undrgradstudentcount_2')->nullable();
            $table->integer('gradstudentcount_4')->nullable();
            $table->integer('inst_act_ugcredit_hrs')->nullable();
            $table->integer('inst_act_gradcredit_hrs')->nullable();
            $table->integer('inst_activity_type')->nullable();
            $table->integer('under_certi_award_level1')->nullable();
            $table->integer('under_certi_award_level2')->nullable();
            $table->integer('under_certi_award_level4')->nullable();
            $table->integer('grad_certi_award_level6')->nullable();
            $table->integer('grad_certi_award_level8')->nullable();
            $table->integer('under_degree_award_level3')->nullable();
            $table->integer('grad_degree_award_level7')->nullable();
            $table->integer('grad_degree_award_level17')->nullable();
            $table->integer('grad_degree_award_level18')->nullable();
            $table->integer('grad_degree_award_level19')->nullable();
            $table->integer('under_degree_award_level5')->nullable();
            $table->integer('cohort_status8')->nullable();
            $table->integer('cohort_status9')->nullable();
            $table->integer('cohort_status13')->nullable();
            $table->integer('cohort_status29')->nullable();
            $table->integer('cohort_status30')->nullable();
            $table->integer('ug_student_perthousandstudent')->nullable();
            $table->integer('ug_average_sch_studentperay')->nullable();
            $table->integer('grad_average_sch_studentperay')->nullable();
            $table->integer('ug_degrees_perthousand_ugstudent')->nullable();
            $table->integer('ug_certi_perthousand_ugstudent')->nullable();
            $table->integer('graddegree_perhundredgradstudent')->nullable();
            $table->integer('grad_certi_perhundred_gradstudent')->nullable();
            $table->integer('bachelordegree_4yeargradrate')->nullable();
            $table->integer('bachelordegree_6yeargradrate')->nullable();
            $table->integer('associatedegree_certi3yeargradrate')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'year']);
            $table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
        });

        //Creates defaultrates table
        Schema::create('defaultrates', function (Blueprint $table) {
            $table->id();
            $table->integer('opeid')->unsigned();
            $table->integer('year')->index();
            $table->float('loan_default_rate', 6, 3)->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['opeid', 'year']);
        });

        //Creates carnegie_classifications table
        Schema::create('carnegie_classifications', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->index();
            $table->integer('year')->index();
            $table->integer('carnegie_basic')->nullable();
            $table->integer('carnegie_ug_program')->nullable();
            $table->integer('carnegie_grad_program')->nullable();
            $table->integer('carnegie_ug_profile')->nullable();
            $table->integer('carnegie_enroll_profile')->nullable();
            $table->integer('carnegie_size_setting')->nullable();
            $table->integer('carnegie_classification2000')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'year']);
            $table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
        });

        //Creates finances table
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->index();
            $table->integer('year')->index();
            $table->bigInteger('public_total_salary_wage')->nullable();
            $table->bigInteger('privateprofit_total_salary_wage')->nullable();
            $table->bigInteger('private_nonprofit_total_salary_wage')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'year']);
            $table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
        });

        //Creates carnegie_classification_types table
        Schema::create('carnegie_classification_types', function(Blueprint $table){
            $table->string('id');
            $table->string('description');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        //Creates school_summary table
        Schema::create('school_summary', function(Blueprint $table){
            $table->id();
            $table->integer('school_id')->index();
            $table->integer('year')->index();
            $table->string('school_name');
            $table->integer('total_studentcount_1')->nullable();
            $table->integer('instruction_staff')->nullable();
            $table->integer('instructors_per_thousand_student')->nullable();
            $table->integer('admin_professional_staff')->nullable();
            $table->integer('admin_professionalstaff_perthousandstudent')->nullable();
            $table->integer('noninstruction_academicstaff')->nullable();
            $table->integer('noninstruction_academicstaff_perthousandstudent')->nullable();
            $table->integer('nonadmin_trade_servicestaff')->nullable();
            $table->integer('nonadmin_tradeservicestaff_perthousandstudent')->nullable();
            $table->integer('all_instructors_staff')->nullable();
            $table->integer('ug_student_perthousandstudent')->nullable();
            $table->integer('instructor_salarypermillion')->nullable();
            $table->integer('adminprofessionalstaff_salarypermillion')->nullable();
            $table->integer('noninstruction_academicstaff_salarypermillion')->nullable();
            $table->integer('nonadmin_tradeservicestaff_salarypermillion')->nullable();
            $table->integer('ug_average_sch_studentperay')->nullable();
            $table->integer('grad_average_sch_studentperay')->nullable();
            $table->integer('ug_degrees_perthousand_ugstudent')->nullable();
            $table->integer('ug_certi_perthousand_ugstudent')->nullable();
            $table->integer('graddegree_perhundredgradstudent')->nullable();
            $table->integer('grad_certi_perhundred_gradstudent')->nullable();
            $table->integer('bachelordegree_4yeargradrate')->nullable();
            $table->integer('bachelordegree_6yeargradrate')->nullable();
            $table->integer('associatedegree_certi3yeargradrate')->nullable();
            $table->double('loan_default_rate', 6, 3)->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'year']);
            $table->foreign('school_id')->references('id')->on('schools')->onUpdate('cascade')->onDelete('cascade');
        });

        //Create variable definitions table
        Schema::create('variabledefinitions', function(Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->string('description', 2048);
            $table->string('datasource')->default('Integrated Postsecondary Education Data System (IPEDS)');
            $table->text('details')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        //Create years table
        Schema::create('years', function(Blueprint $table){
            $table->id();
            $table->integer('year')->unique();
            $table->boolean('active')->default(false);
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('affiliations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('affiliation_id')->nullable()->unsigned()->index()->after('password');
            $table->boolean('active')->default(true);
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->softDeletes();

            $table->foreign('affiliation_id')->references('id')->on('affiliations')->onDelete('cascade');
        });

        /* count_rows(text, text)
         * This function gets the number of records in each table in the schema
         * Use the query below to get the count_rows
         * select table_schema, table_name, count_rows(table_schema, table_name) from information_schema.tables
         *      where table_schema not in ('pg_catalog', 'information_schema') and table_type='BASE TABLE'
         *      order by 3 desc
         *
         */
        DB::unprepared ('create or replace function count_rows(schema text, tablename text) returns integer
            as $body$
                declare
                    result integer;
                    query varchar;
                begin
                    query := \'SELECT count(1) FROM \' || schema || \'.\' || tablename;
                    execute query into result;
                    return result;
                end;
            $body$
            language plpgsql;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Tables are dropped in an order that prevents foreign key constraint violations
        Schema::dropIfExists('peergroup_school');
        Schema::dropIfExists('peergroups');
//        Schema::dropIfExists('role_user');
        Schema::dropIfExists('map_tables');
        Schema::dropIfExists('maps');
        Schema::dropIfExists('reply_comments');
        Schema::dropIfExists('user_comments');
        Schema::dropIfExists('state_abbreviations');
        Schema::dropIfExists('institution_categorys');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('students');
        Schema::dropIfExists('defaultrates');
        Schema::dropIfExists('carnegie_classifications');
        Schema::dropIfExists('finances');
        Schema::dropIfExists('carnegie_classification_types');
        Schema::dropIfExists('school_summary');
        Schema::dropIfExists('variabledefinitions');
        Schema::dropIfExists('years');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('schools');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('affiliation_id');
            $table->dropColumn('active');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_at');
        });

        Schema::dropIfExists('affiliations');

        // Functions/Routines
        DB::unprepared('DROP function IF EXISTS count_rows(text, text)');
    }
};
