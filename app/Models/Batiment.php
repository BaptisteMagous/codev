<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batiment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_methode_dpe',
        'date_etablissement_dpe',
        'geo_adresse',
        'latitude',
        'longitude',
        'classe_consommation_energie'];

    public static function find($id)
    {
    }
}
