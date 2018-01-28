<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampReportProblemsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        // Create table for storing problem's types
        Schema::create('problem_types', function (Blueprint $table) {
            $table->Increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        // Create table for storing problems
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('topic');
            $table->unsignedInteger('problem_type_id');
            $table->text('description');
            $table->unsignedInteger('report_id');
            $table->boolean('is_solve');
            $table->boolean('not_solve');            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('problem_type_id')->references('id')->on('problem_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('report_id')->references('id')->on('users')
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
        Schema::dropIfExists('problem_types');
        Schema::dropIfExists('problems');
    }
}
