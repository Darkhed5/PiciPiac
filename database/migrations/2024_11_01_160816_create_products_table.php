<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
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
=======
return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('user_id'); // Kapcsolódik a felhasználóhoz
            $table->timestamps();

            // Külső kulcs beállítása a felhasználóra
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

>>>>>>> 8d153a246199fbc9b59842c310ec86835b0b8550
    public function down()
    {
        Schema::dropIfExists('products');
    }
<<<<<<< HEAD
}
=======
};
>>>>>>> 8d153a246199fbc9b59842c310ec86835b0b8550
