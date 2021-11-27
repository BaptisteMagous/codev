<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batiments', function (Blueprint $table) {
            $table->id();
            $table->string("nom_methode_dpe");
            $table->string("version_methode_dpe");
            $table->date("date_etablissement_dpe");
            $table->float("consommation_energie");
            $table->string("classe_consommation_energie", 1);
            $table->float("estimation_ges");
            $table->string("classe_estimation_ges", 1);
            $table->integer("annee_construction");
            $table->float("surface_thermique_lot");
            $table->float("latitude");
            $table->float("longitude");
            $table->string("tr001_modele_dpe_type_libelle");
            $table->string("tr002_type_batiment_description");
            $table->integer("code_insee_commune_actualise");
            $table->integer("tv016_departement_code");
            $table->string("geo_adresse");
            $table->float("geo_score");
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
        Schema::dropIfExists('batiments');
    }
}
