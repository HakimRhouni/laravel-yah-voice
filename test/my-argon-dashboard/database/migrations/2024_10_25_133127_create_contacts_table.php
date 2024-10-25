<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compain_id'); // Foreign key to compain table
            $table->string('nom');
            $table->string('raison_social');
            $table->string('ICF')->nullable();
            $table->string('RC')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('num1');
            $table->string('num2')->nullable();
            $table->string('mobile1')->nullable();
            $table->string('mobile2')->nullable();
            $table->string('tel1')->nullable();
            $table->string('tel2')->nullable();
            $table->string('qualification')->nullable(); // Ajout du champ qualification
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('compain_id')->references('id_compain')->on('compain')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
