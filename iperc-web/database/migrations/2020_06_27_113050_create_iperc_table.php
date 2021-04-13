<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpercTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipercs', function (Blueprint $table) {
            $table->id();
            $table->string('consequence_evaluation',10);
            $table->string('exhibition_evaluation',10);
            $table->string('probability_evaluation',10);
            $table->string('total_evaluation',10);
            $table->longText('engineering_controls')->nullable();
            $table->longText('administrative_controls')->nullable();
            $table->longText('epps')->nullable();
            $table->foreignId('task_id')->constrained()->onDelete('cascade');;
            $table->foreignId('danger_id')->constrained()->onDelete('cascade');;
            $table->foreignId('danger_description_id')->constrained()->onDelete('cascade');;
            $table->foreignId('consequence_id')->constrained()->onDelete('cascade');;
            $table->foreignId('risk_id')->constrained();
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
        Schema::dropIfExists('iperc');
    }
}
