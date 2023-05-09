<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories')->nullable()->onDelete('null');
            $table->foreignId('book_id')->constrained('books')->nullable()->onDelete('cascade');
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('oldprice')->nullable();
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
