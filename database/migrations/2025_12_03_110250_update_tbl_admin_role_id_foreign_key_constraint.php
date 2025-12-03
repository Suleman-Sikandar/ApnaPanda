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
        Schema::table('tbl_admin', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['role_id']);
            
            // Recreate the foreign key with onDelete('set null')
            $table->foreign('role_id')
                  ->references('id')
                  ->on('tbl_roles')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_admin', function (Blueprint $table) {
            // Drop the modified foreign key
            $table->dropForeign(['role_id']);
            
            // Restore the original constraint (without onDelete)
            $table->foreign('role_id')
                  ->references('id')
                  ->on('tbl_roles');
        });
    }
};
