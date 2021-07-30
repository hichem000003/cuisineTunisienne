<?php
namespace App\Response;

use App\Entity\Recette;
use phpDocumentor\Reflection\Utils;

class RecetteResponse{


    public function transform(Recette $recette)

    {
        return[
        'id' => (integer) $recette->getId(),
        'refRecett'  =>(string) $recette->getRefRecette(),
        'nomRecette'  =>(string) $recette->getNomRecette(),
        'tempsCuisson' =>(string) $recette->getTempsCuisson(),
        'tempsPreparation'  =>(string) $recette->getTempsPreparation(),
        'photo'  =>(string) $recette->getPhoto(),
        'video'  =>(string) $recette->getVideo(),
        'nbPersonnes'  =>(integer) $recette->getNbPersonnes(),
            'niveauDifficulte'  =>(integer) $recette->getNiveauDifficulte()

            ];

    }












}
