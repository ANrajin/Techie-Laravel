<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_sku');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('set null');

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')
            ->references('id')->on('brands')
            ->onDelete('set null');

            $table->integer('quantity');
            $table->double('price');
            $table->string('slug');

            $table->enum('is_featured', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1'])->default('1');

            $table->text('details')->nullable();
            $table->string('main_thumbnail')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
