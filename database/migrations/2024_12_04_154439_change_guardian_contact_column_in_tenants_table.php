<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tenants', function (Blueprint $table) {
        $table->string('guardian_contact', 20)->change();  // Increase length if needed
    });
}

public function down()
{
    Schema::table('tenants', function (Blueprint $table) {
        $table->integer('guardian_contact')->change();
    });
}

};
