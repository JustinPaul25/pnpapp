<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crime_id')->nullable();
            $table->unsignedBigInteger('complainant_id')->nullable();
            $table->unsignedBigInteger('reporting_id')->nullable();
            $table->unsignedBigInteger('prepared_id')->nullable();
            $table->unsignedBigInteger('case_status_id')->nullable();
            $table->date('crime_date');
            $table->longText('event_detail');
            $table->longText('action_taken');
            $table->longText('summary');
            $table->longText('long');
            $table->longText('lat');
            $table->timestamps();

            $table->foreign('crime_id')->references('id')->on('crimes')->onDelete('cascade');
            $table->foreign('complainant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reporting_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('prepared_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('case_status_id')->references('id')->on('case_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_reports');
    }
}
