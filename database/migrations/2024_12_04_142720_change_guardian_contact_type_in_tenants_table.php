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
            // Modify the 'guardian_contact' column to integer
            $table->integer('guardian_contact')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Rollback the change (if necessary)
            $table->string('guardian_contact')->nullable()->change();
        });
    }
    

};
