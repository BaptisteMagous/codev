<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatimentController extends Controller
{

    public function index(string $type, string $dept = "", int $commune = -1, array $longitude = [], array $latitude = [])
    {
        $data = DB::table('batiments');

        if($dept != ""){
            $data = $data->where("tv016_departement_code", $dept);
        }

        if($commune != -1){
            $data = $data->where("code_insee_commune_actualise", "=", $commune);
        }

        if($longitude != []){
            $data = $data->where("longitude", ">=", $longitude[0]);
            $data = $data->where("latitude", ">=", $latitude[0]);
            $data = $data->where("longitude", "<=", $longitude[1]);
            $data = $data->where("latitude", "<=", $latitude[1]);
        }

        switch ($type){
            case "batiments":
                break;
            case "electricite":
                $data->addSelect('consommation_energie', 'classe_consommation_energie', 'longitude', 'latitude', 'tr002_type_batiment_description', 'code_insee_commune_actualise', 'tv016_departement_code', 'geo_adresse');
                break;
            case "ges":
                $data->addSelect('estimation_ges', 'classe_estimation_ges', 'longitude', 'latitude', 'tr002_type_batiment_description', 'code_insee_commune_actualise', 'tv016_departement_code', 'geo_adresse');
                break;
            default:
                return response()->json("", 404);
        }


        /*$data = $data->reject(function ($entry) {
            return $entry->consommation_energie < 0
                or $entry->estimation_ges < 0
                or $entry->annee_construction > 2100;
        });*/

        $data = $data->get();

        return response()->json($data, 200);
    }

    public function show($type, $batiment_id)
    {
        $batiment = DB::table('batiments')->find($batiment_id);
        return response()->json($batiment, 200);
    }

    public function store(Request $request)
    {
        $Batiment = Batiment::create($request->all());

        return response()->json($Batiment, 201);
    }

    public function update(Request $request, Batiment $batiment)
    {
        $batiment->update($request->all());

        return response()->json($batiment, 200);
    }

    public function delete(Batiment $batiment)
    {
        $batiment->delete();

        return response()->json(null, 204);
    }

    public function dept(string $type, string $dept = "")
    {
        return $this->index($type, $dept);
    }

    public function commune(string $type, int $commune = -1)
    {
        return $this->index($type, "", $commune);
    }

    public function zone(string $type, string $longitude = "", string $latitude = "")
    {
        $longitude = explode(":", $longitude);
        $latitude = explode(":", $latitude);
        $longitude = [floatval($longitude[0]), floatval($longitude[1])];
        $latitude = [floatval($latitude[0]), floatval($latitude[1])];
        return $this->index($type, "", -1, $longitude, $latitude);
    }

    public function test(string $type, string $dept = "", int $commune = -1, array $longitude = [], array $latitude = [])
    {
        return response()->json([
            "type" => $type,
            "dept" => $dept,
            "commune" => $commune,
            "longitude" => $longitude,
            "latitude" => $latitude
        ], 203);
    }
}
