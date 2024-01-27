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
        // $unit = ['Pack', 'Kilogram', 'Liter', 'Package', 'Unit', 'Square Meter', 'Pair', 'Set', 'Meter', 'Gram', 'Hour', 'Yard', 'Inch', 'Gallon'];

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('levels', ['premium', 'discounts', 'popular', 'normal'])->default('normal');
            $table->string('name');
            $table->text('status')->default('available');
            $table->text('description');
            $table->decimal('price')->nullable();
            $table->decimal('discountPercentage')->nullable();
            $table->integer('views')->default(0);
            $table->string('code')->nullable();
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('user_id');
            $table->datetime('expiration_date')->nullable();
            $table->timestamps();
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table
                ->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
            $table
                ->foreign('unit_id')
                ->references('id')
                ->on('units')
                ->onDelete('cascade');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
