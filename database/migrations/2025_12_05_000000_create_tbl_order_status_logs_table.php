<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_order_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('old_status', 50)->nullable();
            $table->string('status_changed_to', 50);
            $table->enum('user_type', ['admin', 'vendor', 'rider', 'system']);
            $table->unsignedBigInteger('user_id');
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('order_id')->references('id')->on('tbl_orders')->onDelete('cascade');
            // Assuming users table is standard 'users', if user_id refers to different tables based on user_type, we might not want a strict FK or we need polymorphic relations.
            // The prompt says "user_id FK -> users", so I will add that constraint.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_order_status_logs');
    }
};
