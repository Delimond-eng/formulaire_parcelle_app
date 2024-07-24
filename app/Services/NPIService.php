<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NPIService
{
    /**
     * Appelle l'API pour vérifier le NPI.
     *
     * @param string $npi
     * @return bool
     */
    public function checkNpi($npi)
    {
        $response = Http::get("https://formulaireidnat.groupepaixservice.net/api/check.npi/{$npi}");

        // Vérifier le statut de la réponse
        if ($response->failed()) {
            return false;
        }

        // Décoder la réponse JSON
        $data = $response->json();

        // Vérifier si la réponse contient des erreurs
        if (isset($data['errors'])) {
            return false;
        }
        // Si tout est bon, retourner true
        if ($data['status'] === 'success') {
            return true;
        }
        // Retourner false en cas de réponse inattendue
        return false;
    }
}