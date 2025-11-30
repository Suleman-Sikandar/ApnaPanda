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
        Schema::create('tbl_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_category_id')
                ->constrained('tbl_module_categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('module_name')->unique();
            $table->string('route')->nullable()->unique();

            $table->boolean('show_in_menu')->default(0);

            $table->string('icon_class')->nullable();

            $table->unsignedInteger('display_order')->nullable();

            $table->boolean('is_active')->default(1);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_modules');
    }
};
