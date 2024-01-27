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
            $table->string('logo')->default('assets/website/img/logo.png');
            $table->string('black_logo')->default('assets/website/img/black_logo.png');
            $table->string('siteName')->default('Marketna');
            $table->string('big_title_1')->default('A New Way');
            $table->string('big_title_2')->default('To Start Business');
            $table->string('sm_title_1')->default('Discover the new world of shopping with our distinctive application');
            $table->string('sm_title_2')->default('Get an innovative shopping experience that combines comfort, variety and quality.');
            $table->string('button')->default('Download');
            $table->string('button_link')->default('#');
            $table->string('three_blcok')->default('Smarter shopping starts here');
            $table->string('image_1')->default('assets/website/img/smart-protect-1.jpg');
            $table->string('title_1')->default('Communication');
            $table->string('sub_title_1')->default('Get the best offers and discounts');
            $table->string('image_2')->default('assets/website/img/smart-protect-2.jpg');
            $table->string('title_2')->default('Easy capture');
            $table->string('sub_title_2')->default('Receive your orders wherever you are');
            $table->string('image_3')->default('assets/website/img/smart-protect-3.jpg');
            $table->string('title_3')->default('Smart Scan');
            $table->string('sub_title_3')->default('Find your favorite products in one place');

            $table->string('feature_1_title')->default('Take a look inside');
            $table->string('feature_1_text_1')->default('Join our growing family');
            $table->string('feature_1_text_2')->default('benefit from a great opportunity to create a sustainable income');
            $table->string('button_1')->default('Learn More');
            $table->string('button_1_link')->default('#');
            $table->string('feature_1_image')->default('assets/website/img/feature-1.png');

            $table->string('feature_2_title')->default('Safe and reliable');
            $table->string('feature_2_text_1')->default('Join us today and start your successful path!,');
            $table->string('feature_2_text_2')->default('We provide a stimulating work environment and comprehensive training to help you achieve success.');
            $table->string('button_2')->default('Learn More');
            $table->string('button_2_link')->default('#');
            $table->string('feature_2_image')->default('assets/website/img/feature-2.png');

            $table->string('client_title')->default('Success Partners');
            $table->string('client_logo_1')->default('assets/website/img/client-1.png');
            $table->string('client_logo_2')->default('assets/website/img/client-2.png');
            $table->string('client_logo_3')->default('assets/website/img/client-3.png');
            $table->string('client_logo_4')->default('assets/website/img/client-4.png');
            $table->string('client_logo_5')->default('assets/website/img/client-5.png');
            $table->string('client_logo_6')->default('assets/website/img/client-6.png');

            $table->string('github')->default('#');
            $table->string('twitter')->default('#');
            $table->string('facebook')->default('#');
            $table->string('android')->default('#');
            $table->string('youtube')->default('#');
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
