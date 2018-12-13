<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\LawPosition;


class LawPositionController extends Controller
{


    /**
     * Retrieve spouses law positions
     *
     * @Rest\View()
     * @Rest\Get("/api/spouses-laws")
     */
    public function getSpouseLaws(Request $request)
    {
        try {
            $em                           = $this->getDoctrine()->getManager();
            $spouseLawPositionsCollection = $em->getRepository(LawPosition::class)->findAll();
            $spouseLawPositions           = [];
            foreach ($spouseLawPositionsCollection as $spouseLawPosition) {
                if ($spouseLawPosition->isSpouse() === true) {
                    $spouseLawPositions[] = [
                        'id'    => $spouseLawPosition->getId(),
                        'name'  => $spouseLawPosition->getName(),
                        'identifier' => $spouseLawPosition->getIdentifier(),
                    ];
                }
                
            }
                       
            return new JsonResponse($spouseLawPositions);
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API ' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
        
    }
    
    
    
}