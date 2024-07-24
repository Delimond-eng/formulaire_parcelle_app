<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreParcelleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'province_id' => 'required|int|exists:provinces,id',
            'commune_id' => 'required|int|exists:communes,id',
            'ville_id' => 'required|int|exists:villes,id',
            'quartier_id' => 'required|int|exists:quartiers,id',
            'adresse' => 'required|string',
            'forme_geometrique' => 'required|string',
            'dimensions' => 'required|string',
            'etage' => 'required|string',
            'nbre_etages' => 'nullable|string',
            'nbre_maisons_location' => 'nullable|int',
            'type_titre' => 'required|string',
            'numero_titre' => 'required|string',
            'description' => 'required|string',
            'maisons' => 'nullable|array',
            'proprietaires' => 'required|array',
            'proprietaires.*.npi_proprietaire' => 'required|string',
            'proprietaires.*.type_proprietaire' => 'required|string',
            'maisons.*.type_usage' => 'required|string',
            'maisons.*.description_activite' => 'nullable|string',
            'maisons.*.caracteristiques' => 'required|string',
            'maisons.*.montant_loyer' => 'required|numeric',
            'maisons.*.montant_loyer_devise' => 'required|string',
            'maisons.*.contrat_bail' => 'required|string',
            'maisons.*.duree_occupation' => 'required|int',
            'maisons.*.duree_occupation_unite' => 'required|string',
            'maisons.*.locataire' => 'required|array',
            'maisons.*.locataire.nom' => 'required|string',
            'maisons.*.locataire.prenom' => 'required|string',
            'maisons.*.locataire.sexe' => 'required|string',
            'maisons.*.locataire.telephone' => 'required|string',
            'maisons.*.locataire.nip_locataire' => 'required|string',
        ];
    }
}