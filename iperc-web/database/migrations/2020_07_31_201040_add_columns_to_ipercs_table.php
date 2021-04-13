<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToIpercsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ipercs', function (Blueprint $table) {
            $table->date('last_update')->nullable()->after('epps');
            
            $table->unsignedBigInteger('user_id')->nullable()->after('risk_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ipercs', function (Blueprint $table) {
            $table->dropColumn('last_update');
            $table->dropForeign(['user_id']);
        });
    }
}
