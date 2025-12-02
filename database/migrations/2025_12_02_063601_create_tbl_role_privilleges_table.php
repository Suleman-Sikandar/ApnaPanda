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
        Schema::create('tbl_role_privilleges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('tbl_roles')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('tbl_modules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_role_privilleges');
    }
};
