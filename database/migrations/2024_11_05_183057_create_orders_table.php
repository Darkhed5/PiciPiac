<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Kapcsolódik a felhasználóhoz
            $table->string('status')->default('feldolgozás alatt');
            $table->decimal('total_price', 8, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            // Külső kulcs beállítása a felhasználóra
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
