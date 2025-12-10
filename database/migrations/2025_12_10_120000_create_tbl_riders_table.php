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
        Schema::create('tbl_riders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('phone')->nullable();
            $table->string('alternative_phone')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('license_number')->nullable();
            $table->date('license_expiry')->nullable();
            $table->string('national_id_number')->nullable();

            $table->text('profile_photo')->nullable();
            $table->text('license_front')->nullable();
            $table->text('license_back')->nullable();
            $table->text('national_id_front')->nullable();
            $table->text('national_id_back')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->integer('current_step')->default(1);
            $table->boolean('is_face_verified')->default(false);
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('approved_by_admin_id')->nullable();
            $table->timestamp('status_updated_at')->nullable();
            $table->text('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_riders');
    }
};

