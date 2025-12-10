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
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->integer('discount_percent')->nullable()->default(0)->after('price');
            $table->decimal('discount_amount', 10, 2)->nullable()->after('discount_percent');
            $table->boolean('has_free_delivery')->default(false)->after('discount_amount');
            $table->decimal('delivery_charge', 10, 2)->nullable()->after('has_free_delivery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->dropColumn(['discount_percent', 'discount_amount', 'has_free_delivery', 'delivery_charge']);
        });
    }
};
