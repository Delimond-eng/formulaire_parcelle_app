<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcelles', function (Blueprint $table) {
            $table->id();
            $table->string("nip_parcelle")->unique();
            $table->string('adresse');
            $table->enum("forme_geometrique", ["Carré","Rectangle", "Losange","Trapèze", "Triangle"]);
            $table->string("dimensions");
            $table->string("etage")->default("non");
            $table->string("nbre_etages")->nullable();
            $table->integer('nbre_maisons_location')->nullable();
            $table->string("type_titre");
            $table->string("numero_titre");
            $table->text("description");
            $table->unsignedBigInteger("province_id");
            $table->unsignedBigInteger("ville_id");
            $table->unsignedBigInteger("commune_id");
            $table->unsignedBigInteger("quartier_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcelles');
    }
};