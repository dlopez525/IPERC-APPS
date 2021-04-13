<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained();
            $table->foreignId('job_position_id')->constrained();
            $table->foreignId('sub_process_id')->constrained();
            $table->foreignId('activity_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->foreignId('danger_id')->constrained();
            $table->foreignId('iperc_id')->constrained();
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
        Schema::dropIfExists('audits');
    }
}
