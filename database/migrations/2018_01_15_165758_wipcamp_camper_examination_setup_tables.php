<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampCamperExaminationSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('exam_questions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->float('score', 5, 2);
            $table->text('data')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('exam_choices', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('question_id');
            $table->text('data')->nullable();
            $table->boolean('is_corrected');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('question_id')->references('id')->on('exam_questions')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('exams', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('choice_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->unique(['user_id', 'question_id', 'choice_id']);
            $table->foreign('user_id')->references('user_id')->on('profile_campers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('exam_questions')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('choice_id')->references('id')->on('exam_choices')
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
        DB::dropIfExists('exams');
        DB::dropIfExists('exam_choices');
        DB::dropIfExists('exam_questions');
    }
}
