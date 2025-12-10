<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_uid', 100)->unique();
            $table->date('invoice_date');
            $table->date('invoice_effective_date')->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->string('status', 20)->default('pending');
            $table->foreignId('created_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};