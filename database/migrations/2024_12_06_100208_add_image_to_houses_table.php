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
        Schema::table('_houses', function (Blueprint $table) {
            $table->string('image')->nullable();  // Adds an 'image' column to store the image path
        });
    }
    
    public function down()
    {
        Schema::table('_houses', function (Blueprint $table) {
            $table->dropColumn('image');  // Removes the 'image' column if needed
        });
    }
    
};
