<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->foreignId('bed_id')->constrained('beds')->onDelete('cascade');
            $table->date('start_date');
            $table->date('expected_leave_date')->nullable();
            $table->string('admission_floor_location', 255)->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('approved_by_user')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};