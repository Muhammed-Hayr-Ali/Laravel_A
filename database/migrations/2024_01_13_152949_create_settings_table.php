<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('showAlert')->default(true)->nullable();
            $table->boolean('multilingual')->default(true)->nullable();
            $table->string('defaultLanguage')->default('ar')->nullable();
            $table->string('logo')->default('assets/website/img/logo.png')->nullable();
            $table->string('black_logo')->default('assets/website/img/black_logo.png')->nullable();
            $table->string('siteName')->default('Marketna')->nullable();
            $table->string('big_title_1')->default('A New Way')->nullable();
            $table->string('big_title_2')->default('To Start Business')->nullable();
            $table->string('sm_title_1')->default('Discover the new world of shopping with our distinctive application')->nullable();
            $table->string('sm_title_2')->default('Get an innovative shopping experience that combines comfort, variety and quality.')->nullable();
            $table->string('button')->default('Download')->nullable();
            $table->string('button_link')->default('#')->nullable();
            $table->string('three_blcok')->default('Smarter shopping starts here')->nullable();
            $table->string('image_1')->default('assets/website/img/smart-protect-1.jpg')->nullable();
            $table->string('title_1')->default('Communication')->nullable();
            $table->string('sub_title_1')->default('Get the best offers and discounts')->nullable();
            $table->string('image_2')->default('assets/website/img/smart-protect-2.jpg')->nullable();
            $table->string('title_2')->default('Easy capture')->nullable();
            $table->string('sub_title_2')->default('Receive your orders wherever you are')->nullable();
            $table->string('image_3')->default('assets/website/img/smart-protect-3.jpg')->nullable();
            $table->string('title_3')->default('Smart Scan')->nullable();
            $table->string('sub_title_3')->default('Find your favorite products in one place')->nullable();

            $table->string('feature_1_title')->default('Take a look inside')->nullable();
            $table->string('feature_1_text_1')->default('Join our growing family')->nullable();
            $table->string('feature_1_text_2')->default('benefit from a great opportunity to create a sustainable income')->nullable();
            $table->string('button_1')->default('Learn More')->nullable();
            $table->string('button_1_link')->default('#')->nullable();
            $table->string('feature_1_image')->default('assets/website/img/feature-1.png')->nullable();

            $table->string('feature_2_title')->default('Safe and reliable')->nullable();
            $table->string('feature_2_text_1')->default('Join us today and start your successful path!,')->nullable();
            $table->string('feature_2_text_2')->default('We provide a stimulating work environment and comprehensive training to help you achieve success.')->nullable();
            $table->string('button_2')->default('Learn More')->nullable();
            $table->string('button_2_link')->default('#')->nullable();
            $table->string('feature_2_image')->default('assets/website/img/feature-2.png')->nullable();

            $table->string('client_title')->default('Success Partners')->nullable();
            $table->string('client_logo_1')->default('assets/website/img/client-1.png')->nullable();
            $table->string('client_logo_2')->default('assets/website/img/client-2.png')->nullable();
            $table->string('client_logo_3')->default('assets/website/img/client-3.png')->nullable();
            $table->string('client_logo_4')->default('assets/website/img/client-4.png')->nullable();
            $table->string('client_logo_5')->default('assets/website/img/client-5.png')->nullable();
            $table->string('client_logo_6')->default('assets/website/img/client-6.png')->nullable();

            $table->string('github')->default('#')->nullable();
            $table->string('twitter')->default('#')->nullable();
            $table->string('facebook')->default('#')->nullable();
            $table->string('android')->default('#')->nullable();
            $table->string('youtube')->default('#')->nullable();
            $table->integer('visitors')->default(0);

            $table->string('year')->default(2024);

            $table->timestamps();
        });
    }

    /**feature
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
