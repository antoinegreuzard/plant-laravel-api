<?php

namespace App\Helpers;

use App\Models\Plant;

class PlantAdviceHelper
{
    public static function getPersonalizedAdvice(Plant $plant): array
    {
        $advice = [];

        // Ensoleillement
        switch ($plant->sunlight_level) {
            case 'low':
                $advice[] = "Placez votre plante à l'ombre ou dans un endroit peu lumineux.";
                break;
            case 'medium':
                $advice[] = "Votre plante a besoin de lumière indirecte, évitez le soleil.";
                break;
            case 'high':
                $advice[] = "Assurez-vous que votre plante reçoit beaucoup de lumière.";
                break;
        }

        // Température
        if ($plant->temperature !== null) {
            if ($plant->temperature < 15) {
                $advice[] = "Protégez votre plante du froid.";
            } elseif ($plant->temperature > 30) {
                $advice[] = "Évitez l'exposition à des températures élevées et arrosez.";
            }
        }

        // Humidité
        switch ($plant->humidity_level) {
            case 'low':
                $advice[] = "Pulvérisez régulièrement de l'eau sur les feuilles.";
                break;
            case 'medium':
                $advice[] = "L'humidité est correcte, surveillez les signes de sécheresse.";
                break;
            case 'high':
                $advice[] = "Assurez une bonne ventilation pour éviter les moisissures.";
                break;
        }

        return $advice;
    }
}
