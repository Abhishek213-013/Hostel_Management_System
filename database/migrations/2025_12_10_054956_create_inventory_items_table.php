<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_item_id')->nullable()->constrained('invoice_items')->onDelete('set null');
            $table->foreignId('inventory_id')->nullable()->constrained('inventory_items')->onDelete('set null');
            $table->foreignId('used_by')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('used_at')->nullable();
            $table->string('status', 20)->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};