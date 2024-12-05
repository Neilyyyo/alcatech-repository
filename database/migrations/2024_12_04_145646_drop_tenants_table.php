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
    Schema::dropIfExists('tenants');
}

public function down()
{
    // Optionally, add the code to recreate the tenants table if you need to rollback this migration
    Schema::create('tenants', function (Blueprint $table) {
        $table->id();
        // Add the same columns here as before
        $table->string('firstName');
        $table->string('lastName');
        $table->string('email')->unique();
        $table->foreignId('room_ID')->constrained('rooms');
        $table->date('date_in');
        $table->string('guardian_name')->nullable();
        $table->string('guardian_contact')->nullable();
        $table->timestamps();
    });
}

};
