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
        Schema::table('tbl_vendors', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspended'])->nullable();
            $table->foreignId('approved_by_admin_id')->nullable()->constrained('tbl_admin')->nullOnDelete();
            $table->timestamp('status_updated_at')->nullable()->useCurrent();
            $table->text('rejection_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_vendors', function (Blueprint $table) {
            //
        });
    }
};
