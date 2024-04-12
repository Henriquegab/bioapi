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
        Schema::create('animais', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->string('lat');
            $table->string('lon');
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('animais', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('Cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('animais', function (Blueprint $table) {
            $table->dropForeign('animais_user_id_foreign');
        });


        Schema::dropIfExists('animais');
    }
};
