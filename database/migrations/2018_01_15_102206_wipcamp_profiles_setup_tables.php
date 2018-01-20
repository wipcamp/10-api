<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampProfilesSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('profile_genders', function (Blueprint $table) {
            $table->tinyIncrements('id')->unsigned();
            $table->string('name', 32)->unique();
            $table->string('display_name', 64)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('profile_religions', function (Blueprint $table) {
            $table->tinyIncrements('id')->unsigned();
            $table->string('name', 32)->unique();
            $table->string('display_name', 64)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary()->default(10000);
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('first_name_en', 64);
            $table->string('last_name_en', 64);
            $table->string('nickname', 32);
            $table->unsignedTinyInteger('gender_id');
            $table->string('citizen_id', 13)->nullable();
            $table->unsignedTinyInteger('religion_id');
            $table->date('birth_at')->nullable();
            $table->string('blood_group', 16);
            $table->string('congenital_diseases')->nullable();
            $table->string('allergic_foods')->nullable();
            $table->string('congenital_drugs')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('profile_genders')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('religion_id')->references('id')->on('profile_religions')
                ->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::create('profile_registrants', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->text('addr');
            $table->string('addr_prov', 64);
            $table->string('addr_dist', 64);
            $table->string('telno_personal', 15);
            $table->string('edu_name', 128);
            $table->string('edu_lv', 64);
            $table->string('edu_major', 64);
            $table->float('edu_gpax', 3, 2);
            $table->text('known_via')->nullable();
            $table->text('activities')->nullable();
            $table->text('skill_computer')->nullable();
            $table->text('past_camp')->nullable();
            $table->string('parent_first_name', 64);
            $table->string('parent_last_name', 64);
            $table->string('parent_relation', 64);
            $table->string('telno_parent', 15);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('user_id')->references('user_id')->on('profiles')
                ->onUpdate('cascade')->onDelete('cascade');
            
        });

        Schema::create('profile_registrant_favfields', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('order');
            $table->string('institute_name', 64)->nullable();
            $table->string('field_name', 64)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->unique(['user_id', 'order']);
            $table->foreign('user_id')->references('user_id')->on('profile_registrants')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('profile_campers', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id')->unique();
            $table->unsignedInteger('section_id');
            $table->date('checked_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('user_id')->references('user_id')->on('profiles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('camp_sections')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::create('profile_staffs', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->unsignedInteger('section_id')->nullable();
            $table->string('student_id', 11);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('user_id')->references('user_id')->on('profiles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('camp_sections')
                ->onUpdate('cascade')->onDelete('restrict');
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::dropIfExists('profile_staffs');
        DB::dropIfExists('profile_campers');
        DB::dropIfExists('profile_registrant_favfields');
        DB::dropIfExists('profile_registrants');
        DB::dropIfExists('profile_profiles');
        DB::dropIfExists('profile_religions');
        DB::dropIfExists('profile_genders');
    }
}
