<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_audit_trails', function (Blueprint $table) {
            $table->string('change_to')->nullable();
            $table->string('change_from')->nullable();
            $table->string('action_name')->nullable();
            $table->string('action')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('risk_audit_trails', function (Blueprint $table) {
            //
        });
    }
};
