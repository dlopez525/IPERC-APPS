<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpercFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iperc_files', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('responsable', 255)->nullable();
            $table->date('creation_date')->nullable();
            $table->date('last_update')->nullable();
            $table->string('leader')->nullable();
            $table->string('team', 255)->nullable();
            $table->foreignId('headquarter_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable()->default(2);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('iperc_files');
    }
}
