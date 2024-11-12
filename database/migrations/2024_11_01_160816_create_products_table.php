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
            $table->bigIncrements('id'); // Termék egyedi azonosítója
            $table->string('name', 255); // Termék neve, max 255 karakter
            $table->text('description')->nullable(); // Termék leírása, opcionális
            $table->decimal('price', 8, 2); // Termék ára, két tizedesjeggyel
            $table->string('category', 255); // Termék kategóriája, max 255 karakter
            $table->unsignedInteger('stock'); // Készlet mennyisége, csak pozitív értékek
            $table->string('image_path')->nullable(); // Kép elérési útja, opcionális
            $table->timestamps(); // Létrehozás és frissítés időpontja
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
