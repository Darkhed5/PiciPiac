<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('quantity', 8, 2)->nullable()->after('price'); // Mennyiség
            $table->string('unit', 10)->nullable()->after('quantity'); // Mértékegység
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'unit']);
        });
    }
};
