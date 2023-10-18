<?php
/*  Create archive tables for school_summary seeded from CSV files. In case of a new school_summary set for a
    year, the old school_summary will be stored in these archive tables to be retrieved by
    the admin at a later stage in case the new CSV file fails to load school_summary
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        //Creates employees archive table
        Schema::create('archive_employees', function (Blueprint $table) {
            $table->id('sequence_id');
            $table->integer('id');
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

            //$table->unique(['school_id', 'year']);
        });

        //Creates students archive table
        Schema::create('archive_students', function (Blueprint $table) {
            $table->id('sequence_id');
            $table->integer('id');
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

            //$table->unique(['school_id', 'year']);
        });

        //Creates defaultrates archive table
        Schema::create('archive_defaultrates', function (Blueprint $table) {
            $table->id('sequence_id');
            $table->integer('id');
            $table->integer('opeid')->unsigned();
            $table->integer('year')->index();
            $table->float('loan_default_rate', 6, 3)->nullable();
            $table->timestamps();
            $table->softDeletes();

            //$table->unique(['opeid', 'year']);
        });

        //Creates carnegie_classifications archive table
        Schema::create('archive_carnegie_classifications', function (Blueprint $table) {
            $table->id('sequence_id');
            $table->integer('id');
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

            //$table->unique(['school_id', 'year']);
        });

        //Creates finances table
        Schema::create('archive_finances', function (Blueprint $table) {
            $table->id('sequence_id');
            $table->integer('id');
            $table->integer('school_id')->index();
            $table->integer('year')->index();
            $table->bigInteger('public_total_salary_wage')->nullable();
            $table->bigInteger('privateprofit_total_salary_wage')->nullable();
            $table->bigInteger('private_nonprofit_total_salary_wage')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //$table->unique(['school_id', 'year']);
        });

        //Creates school_summary archive table
        Schema::create('archive_school_summary', function(Blueprint $table){
            $table->id('sequence_id');
            $table->integer('id');
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
            $table->timestamps();

            //$table->unique(['school_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop archive tables
        Schema::dropIfExists('archive_employees');
        Schema::dropIfExists('archive_students');
        Schema::dropIfExists('archive_defaultrates');
        Schema::dropIfExists('archive_carnegie_classifications');
        Schema::dropIfExists('archive_finances');
        Schema::dropIfExists('archive_school_summary');
    }
};
