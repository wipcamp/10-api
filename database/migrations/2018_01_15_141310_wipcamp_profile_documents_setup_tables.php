<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WipcampProfileDocumentsSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        Schema::create('document_formats', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 32)->unique();
            $table->string('mime_type', 32)->unique();
            $table->string('display_name', 64)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('document_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 32)->unique();
            $table->string('display_name', 64)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('format_id');
            $table->text('path');
            $table->datetime('issued_at')->nullable();
            $table->boolean('is_approve')->nullable();
            $table->text('approve_reason')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(
                    DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                );

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('document_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('format_id')->references('id')
                ->on('document_formats')->onUpdate('cascade')
                ->onDelete('restrict');
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
        DB::dropIfExists('documents');
        DB::dropIfExists('document_types');
        DB::dropIfExists('document_formats');
    }
}
