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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_ID')->constrained('tenants')->onDelete('cascade');  // Foreign key to tenants table
            $table->decimal('amount', 8, 2);  // Payment amount
            $table->string('mod_of_payment');  // Mode of payment (e.g., cash, credit)
            $table->string('invoice');  // Invoice number
            $table->timestamp('date_of_payment')->useCurrent();  // Date of payment
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
