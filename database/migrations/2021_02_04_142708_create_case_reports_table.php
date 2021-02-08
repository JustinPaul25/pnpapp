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
            $table->unsignedBigInteger('reported_id')->nullable();
            $table->unsignedBigInteger('prepared_id')->nullable();
            $table->unsignedBigInteger('case_status_id')->nullable();
            $table->date('crime_date');
            $table->string('focus_crime_type')->nullable();
            $table->longText('event_detail')->nullable();
            $table->longText('action_taken')->nullable();
            $table->longText('summary')->nullable();
            $table->string('address')->nullable();
            $table->double('long', 11, 8);
            $table->double('lat', 10, 8);
            $table->boolean('is_witness');
            $table->timestamps();

            $table->foreign('crime_id')->references('id')->on('crimes')->onDelete('cascade');
            $table->foreign('complainant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reported_id')->references('id')->on('users')->onDelete('cascade');
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
