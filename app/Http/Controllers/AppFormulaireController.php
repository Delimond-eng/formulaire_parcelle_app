<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParcelleRequest;
use App\Models\Achat;
use App\Models\Commune;
use App\Models\Locataire;
use App\Models\Modele;
use App\Models\Moto;
use App\Models\MotoType;
use App\Models\Parcelle;
use App\Models\ParcelleMaisonLocation;
use App\Models\Proprietaire;
use App\Models\Province;
use App\Models\Quartier;
use App\Models\Ville;
use App\Services\NPIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppFormulaireController extends Controller
{
    protected NPIService $nPIService;

    public function __construct(NPIService $nPIService){
        $this->nPIService = $nPIService;
    }
    public function store(StoreParcelleRequest $request)
    {

        $data = $request->validated();
        /**
         * Verification du  NIP proprietaire
         * @var mixed
         */
        if($request->has('proprietaires') && $request->filled('proprietaires')){
            $proprietaires = $data['proprietaires'];
            foreach ($proprietaires as $proprietaire) {
                 $isNPIProprietaireValid = $this->nPIService->checkNpi($proprietaire['npi_proprietaire']);
                if (!$isNPIProprietaireValid) {
                    return redirect()->back()->withErrors(['npi' => "NPI locataire invalide pour une des maisons !"])->withInput();
                }
            }
        }

        /**
         * Verification de tous les NIP des locataires entrés
        */
        foreach ($data['maisons'] as $maison) {
            $isNPILocataireValid = $this->nPIService->checkNpi($maison['locataire']['nip_locataire']);
            if (!$isNPILocataireValid) {
                return redirect()->back()->withErrors(['npi' => "NPI locataire invalide pour une des maisons !"])->withInput();
            }
        }
        /**
         * Genere le NIP Parcelle unique
         * @var mixed
        */
        $numQuartier = str_pad("".$data['quartier_id']."",2, "0", STR_PAD_LEFT);
        $communeCode = Commune::where('commune_id', $data['commune_id'])->first()["code"];
        $data['nip_parcelle'] = Parcelle::generateUniqueCode($communeCode, $numQuartier);
        $parcelle = Parcelle::create($data);

        if (isset($parcelle)) {
            foreach($data['proprietaires'] as $proprietaire){
                $proprietaire['npi_parcelle'] = $parcelle->nip_parcelle;
                $proprietaire['parcelle_id'] = $parcelle->id;
                Proprietaire::create($proprietaire);
            }
            if (count($data["maisons"]) > 0) {
                foreach ($data["maisons"] as $maison) {
                    $maison['parcelle_id'] = $parcelle->id;
                    $locataire = $maison['locataire'];
                    $latestMaison = ParcelleMaisonLocation::create($maison);
                    if (isset($latestMaison)) {
                        $locataire['maison_id']=$latestMaison->id;
                        Locataire::create($locataire);
                    }
                }
            }
            return redirect()->back()->with([
                'success' => 'Parcelle enregistrés avec succès !',
                'npi'=> $parcelle->nip_parcelle
            ]);
        }
    }



    public function gotoView()
    {
        $provinces = Province::all();
        return view('formulaire-parcelle', [
            'titres'=> ['Certificat d’Enregistrement', 'Livré de Logeur', 'Fiche parcellaire'],
            'types'=>['Commerciale', 'Habitation'],
            'formes'=>['Carré', 'Rectangle', 'Losange', 'Trapèze', 'Triangle'],
            'provinces'=>$provinces,
        ]);
    }

    private function savePhoto(Request $request, string $param) :string
    {
        if ($request->hasFile($param)) {
                $domain = $request->getHttpHost();
                $image = $request->file($param);
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/motos'), $imageName);
                $path = 'http://' . $domain . '/uploads/motos/' . $imageName;
            return $path;
        }
        return "";
    }


        /**
     * Summary of getProvinces
     * @return JsonResponse|mixed
     */
    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    /**
     * *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse|mixed
     */
    public function getVilles(Request $request)
    {
        $provinceId = $request->query('province_id');
        $villes = [];
        if ($provinceId) {
            $villes = Ville::where('province_id', $provinceId)->get();
        } else {
            $villes = Ville::all();
        }
        return response()->json($villes);
    }
    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse|mixed
     */
    public function getCommunes(Request $request)
    {
        $villeId = $request->query('ville_id');
        $communes = [];
        if ($villeId) {
            $communes  = Commune::where('ville_id', $villeId)->get();
        } else {
            $communes = Commune::all();
        }
        return response()->json($communes);
    }

    /**
     * Summary of getQuartiers
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getQuartiers(Request $request){
        $communeId = $request->query('commune_id');
        $quartiers = [];
        if ($communeId) {
            $quartiers = Quartier::where('commune_id', $communeId)->get();
        } else {
            $quartiers = Quartier::all();
        }
        return response()->json($quartiers);
    }

}
