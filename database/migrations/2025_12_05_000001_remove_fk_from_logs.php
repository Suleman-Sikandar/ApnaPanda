<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_order_status_logs', function (Blueprint $table) {
            // Drop foreign key using the standard naming convention or array syntax
            // Format: table_column_foreign
            $table->dropForeign(['user_id']); 
        });
    }

    public function down(): void
    {
        // Don't restore it as it's wrong
    }
};
