<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Remove the guardian columns
            $table->dropColumn(['guardian_name', 'guardian_contact']);
            
            // Add a column for tenant image
            $table->string('image')->nullable(); // Image column for tenant's picture
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Add the guardian columns back if rolling back
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact')->nullable();
            
            // Remove the image column
            $table->dropColumn('image');
        });
    }
}
