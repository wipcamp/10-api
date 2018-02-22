<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        // Create table for timetable
        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('event');
            $table->text('description');
            $table->string('location');
            $table->timestamp('start');
            $table->timestamp('end');            
            $table->unsignedInteger('created_id');
            $table->unsignedInteger('role_team_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('created_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_team_id')->references('id')->on('role_teams')
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
        Schema::drop('timetables');
    }
}
