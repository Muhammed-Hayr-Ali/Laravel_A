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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('status')->nullable();;
            $table->string('phone_number')->unique()->nullable();
            $table->enum('gender', ['Unspecified', 'Male', 'Female'])->default('Unspecified');
            $table->string('date_birth')->nullable();;
            $table->string('profile')->nullable();;
            $table->string('password');
            $table->enum('permissions', ['user', 'moderator', 'admin', 'banned'])->default('user');
            $table->dateTime('expiration_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('default_address')->nullable();
            $table->rememberToken();
            $table->timestamps();

        });
    }
    // notification
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
