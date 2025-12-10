<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained('inventory_items')->onDelete('cascade');
            $table->string('name', 150);
            $table->string('category', 100)->nullable();
            $table->integer('quantity')->default(1);
            $table->foreignId('created_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_floors');
    }
};