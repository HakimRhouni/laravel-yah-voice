<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compain', function (Blueprint $table) {
            $table->id('id_compain');               // Colonne Id compain
            $table->string('nom_compain');          // Colonne Nom compain
            $table->boolean('actif')->default(true); // Colonne actif ou inactif (booléen)
            $table->timestamps();                   // Crée automatiquement les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compain');
    }
}
