<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imagens', function (Blueprint $table) {
            $table->id();
            $table->string('caminho');
            $table->string('tipo');
            $table->unsignedBigInteger('animal_id')->nullable();
            $table->unsignedBigInteger('user_id');


            $table->timestamps();
        });

        Schema::table('imagens', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('Cascade');
            $table->foreign('animal_id')->references('id')->on('animais')->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imagens', function (Blueprint $table) {
            $table->dropForeign('imagens_user_id_foreign');
            $table->dropForeign('imagens_animal_id_foreign');
        });

        Schema::dropIfExists('imagens');
    }
};
