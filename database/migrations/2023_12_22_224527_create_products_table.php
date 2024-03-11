<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * productName
     * description
     * thumbnailImage
     * price
     * category_id
     * productLevel_id
     * status_id
     * unit_id
     * quantity
     * availableQuantity
     * minimumQuantity
     * expirationDate
     */
    public function up(): void
    {
        // $unit = ['Pack', 'Kilogram', 'Liter', 'Package', 'Unit', 'Square Meter', 'Pair', 'Set', 'Meter', 'Gram', 'Hour', 'Yard', 'Inch', 'Gallon'];

        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('productName');
            $table->string('description');
            $table->string('thumbnailImage');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->string('code');
            $table->integer('availableQuantity')->default(0);
            $table->integer('minimumQuantity')->default(0);
            $table->datetime('expiration_date')->nullable();
            $table->integer('view')->default(0);

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('unit_id');
            $table->decimal('quantity', 10, 2)->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
