<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampCampDatasSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('camps', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->smallInteger('season')->unsigned();
            $table->string('theme_name', 32);
            $table->text('description')->nullable();
            $table->dateTime('opened_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->dateTime('annouced_at')->nullable();
            $table->date('started_at');
            $table->date('ended_at');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('camp_sections', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 32);
            $table->string('display_name', 64)->nullable();
            $table->string('label_color', 7)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('section_scores', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('section_id');
            $table->float('score', 6, 2);
            $table->text('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('section_id')->references('id')->on('camp_sections')
                ->onUpdate('cascade')->onDelete('cascade');
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
        DB::dropIfExists('section_scores');
        DB::dropIfExists('camp_sections');
        DB::dropIfExists('camps');
    }
}
