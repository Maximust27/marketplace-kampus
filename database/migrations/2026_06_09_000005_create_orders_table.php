<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 20)->unique();
            $table->foreignId('buyer_id')->constrained('users');
            $table->foreignId('seller_id')->constrained('users');
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
            $table->decimal('total_amount', 12, 2);
            $table->text('notes')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users');
            $table->text('cancelled_reason')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('buyer_id');
            $table->index('seller_id');
            $table->index('status');
            $table->index(['buyer_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
