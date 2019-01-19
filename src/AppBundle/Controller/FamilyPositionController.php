<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\FamilyPosition;


class FamilyPositionController extends Controller
{


    /**
     * Retrieve family positions
     *
     * @Rest\View()
     * @Rest\Get("/api/family-positions")
     */
    public function getFamilyPositionsAction(Request $request)
    {
        try {
            $em                        = $this->getDoctrine()->getManager();
            $familyPositionsCollection = $em->getRepository(FamilyPosition::class)->findAll();
            $familyPositions           = [];
            foreach ($familyPositionsCollection as $familyPosition) {
                $familyPositions[] = [
                    'id'                      => $familyPosition->getId(),
                    'name'                    => $familyPosition->getName(),
                    'identifier'              => $familyPosition->getIdentifier(),
                ];
            }
                       
            $response = new JsonResponse($familyPositions);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API <pre>' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
        
    }
    
    
    
}