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
        Schema::create('tbl_vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('alternative_phone')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_type')->nullable();
            $table->string('category')->nullable();
            $table->string('business_registration_number')->nullable()->unique();
            $table->string('GST_number')->nullable()->unique();
            $table->string('PAN_number')->nullable()->unique();
            $table->string('business_email')->nullable()->unique();
            $table->string('business_phone')->nullable();
            $table->year('establishment_year')->nullable();
            $table->string('website_url')->nullable();
            $table->longText('description')->nullable();

            $table->text('logo')->nullable();
            $table->text('cnic_front')->nullable();
            $table->text('cnic_back')->nullable();
            $table->text('registration_certificate')->nullable();
            $table->text('GST_certificate')->nullable();
            $table->text('PAN_card')->nullable();
            $table->text('shop_image')->nullable();

            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('IFSC_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account_type')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_vendors');
    }
};
