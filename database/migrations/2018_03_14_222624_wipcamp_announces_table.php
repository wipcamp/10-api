<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampAnnouncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        // Create table for announce
        Schema::create('announces', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('topic');
            $table->text('description');           
            $table->unsignedInteger('creater_id');
            $table->unsignedInteger('role_team_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
            ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('creater_id')->references('id')->on('users')
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
        Schema::drop('announces');
    }
}
