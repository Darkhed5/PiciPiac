<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Felhasználó ID
            $table->unsignedBigInteger('product_id'); // Termék ID
            $table->integer('quantity'); // Mennyiség
            $table->timestamps();
    
            // Külső kulcsok
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }    
}
