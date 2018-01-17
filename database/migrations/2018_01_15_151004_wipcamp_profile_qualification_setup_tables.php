<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampProfileQualificationSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('eval_criterias', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 32);
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('eval_questions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('data');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('eval_question_criterias', function (Blueprint $table) {
            $table->increment('id')->unasigned();
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('criteria_id');
            $table->float('percentage', 5, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->unique(['question_id', 'criteria_id']);
            $table->foreign('question_id')->references('id')
                ->on('eval_questions')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('criteria_id')->references('id')
                ->on('eval_criterias')->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('eval_answers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('question_id');
            $table->text('data')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->unique(['user_id', 'question_id']);
            $table->foreign('user_id')->references('user_id')->on('profile_registrants')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_id')->references('id')
                ->on('eval_questions')->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('evals', function (Blueprint $table) {
            $table->unsignedInteger('answer_id');
            $table->unsignedInteger('criteria_id');
            $table->unsignedInteger('checker_id');
            $table->float('score', 5, 2);
            $table->text('comment')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->unique(['answer_id', 'criteria_id', 'checker_id']);
            $table->foreign('answer_id')->references('id')->on('eval_answers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('criteria_id')->references('criteria_id')
                ->on('eval_question_criterias')->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('checker_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('evals_denorm', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->float('score');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
            
            $table->foreign('user_id')->references('user_id')->on('profile_registrants')
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
        DB::dropIfExists('evals_denorm');
        DB::dropIfExists('evals');
        DB::dropIfExists('eval_answers');
        DB::dropIfExists('eval_questions_criterias');
        DB::dropIfExists('eval_questions');
        DB::dropIfExists('eval_criterias');
    }
}
