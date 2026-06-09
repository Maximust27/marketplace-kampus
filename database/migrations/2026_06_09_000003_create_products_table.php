<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('name', 255);
            $table->string('slug', 280)->unique();
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('stock')->default(1);
            $table->string('condition')->default('new'); // new, used_good, used_normal
            $table->string('location', 255)->nullable();
            $table->string('image_path', 500)->nullable();
            $table->string('status')->default('active'); // active, inactive, sold
            $table->unsignedInteger('sold_count')->default(0);
            $table->decimal('avg_rating', 2, 1)->default(0.0);
            $table->unsignedInteger('review_count')->default(0);
            $table->timestamps();

            // Indexes
            $table->index(['status', 'category_id', 'condition']);
            $table->index('price');
            $table->index('created_at');
            $table->fullText(['name', 'description']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
