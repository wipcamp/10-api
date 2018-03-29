<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampAssignProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('assigns', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('problem_id');
            $table->unsignedInteger('role_team_id')->nullable();       
            $table->unsignedInteger('assigned_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->unique(['problem_id', 'role_team_id', 'assigned_id']);

            $table->foreign('problem_id')->references('id')->on('problems')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_team_id')->references('id')->on('role_teams')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('assigned_id')->references('id')->on('users')
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
        Schema::dropIfExists('assigns');
    }
}
