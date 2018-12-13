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
    public function getFamilyPositions(Request $request)
    {
        try {
            $em                        = $this->getDoctrine()->getManager();
            $familyPositionsCollection = $em->getRepository(FamilyPosition::class)->findAll();
            $familyPositions           = [];
            foreach ($familyPositionsCollection as $familyPosition) {
                if ($familyPosition->getLawPositions() !== null) {

                    $familyPositions[] = [
                        'id'                      => $familyPosition->getId(),
                        'name'                    => $familyPosition->getName(),
                        'identifier'              => $familyPosition->getIdentifier(),
                        'law_position_id'         => $familyPosition->getLawPositions()->getId(),
                        'law_position_identifier' => $familyPosition->getLawPositions()->getIdentifier(),
                        'law_position_name'       => $familyPosition->getLawPositions()->getName(),
                    ];
                }
                
            }
                       
            return new JsonResponse($familyPositions);
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API <pre>' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
        
    }
    
    
    
}