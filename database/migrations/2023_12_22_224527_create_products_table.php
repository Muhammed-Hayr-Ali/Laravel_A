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
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->string('code');
            $table->integer('minimum_Qty')->default(0);
            $table->integer('quantity')->default(0);
            $table->datetime('expiration_date')->nullable();
            $table->text('description');
            $table->decimal('tax')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('price')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('views')->default(0);
            $table->timestamps();
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table
                ->foreign('level_id')
                ->references('id')
                ->on('levels');
            $table
                ->foreign('status_id')
                ->references('id')
                ->on('statuses');
            $table
                ->foreign('brand_id')
                ->references('id')
                ->on('brands');
            $table
                ->foreign('unit_id')
                ->references('id')
                ->on('units');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
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
