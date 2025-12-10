<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('common_type_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('common_maintype_info')->onDelete('cascade');
            $table->string('name', 150);
            $table->string('slug', 150);
            $table->decimal('position', 10, 4)->default(0);
            $table->boolean('status')->default(true);
            $table->json('metadata')->nullable();
            $table->integer('update_count')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('last_modified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('last_modified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Composite unique constraint
            $table->unique(['type_id', 'slug']);
            
            // Indexes for performance
            $table->index(['type_id', 'status', 'position']);
            $table->index(['status', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('common_type_info');
    }
};