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
            $table->bigInteger('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('status');
            $table->float('quantity');
            $table->float('price');
            $table->text('profile_picture')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
