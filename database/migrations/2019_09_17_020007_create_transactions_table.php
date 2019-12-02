<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('control_id');
            $table->integer('institution_id')->default(0);
            $table->integer('document_id')->default(0);
            $table->integer('status_id')->default(1);
            $table->integer('priority_id')->default(0);
            $table->integer('assign_id')->default(0);
            $table->string('subject')->nullable();
            $table->text('comments')->nullable();
            $table->string('image_filename')->nullable();
            $table->boolean('is_archive')->default(0);
            $table->integer('is_archive_by')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
