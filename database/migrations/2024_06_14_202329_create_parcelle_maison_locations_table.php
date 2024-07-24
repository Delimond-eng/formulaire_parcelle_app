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
        Schema::create('maison_locations', function (Blueprint $table) {
            $table->id();
            $table->enum('type_usage', ['Commerciale','Habitation']);
            $table->text('description_activite')->nullable();
            $table->string('caracteristiques');
            $table->float('montant_loyer');
            $table->string('montant_loyer_devise')->default('CDF');
            $table->string('contrat_bail')->default("non");
            $table->integer("duree_occupation");
            $table->string("duree_occupation_unite");
            $table->unsignedBigInteger('parcelle_id');
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
        Schema::dropIfExists('maison_locations');
    }
};