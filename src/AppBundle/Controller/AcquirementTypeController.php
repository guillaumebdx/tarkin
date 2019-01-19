<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Request\ParamFetcherInterface;
use AppBundle\Entity\AcquirementType;


class AcquirementTypeController extends Controller
{


    /**
     * Retrieve acquirement types for a married persons
     *
     * @Rest\View()
     * @Rest\Get("/api/acquirement-types")
     */
    public function getAcquirementTypesAction(Request $request)
    {
        try {
            $em                         = $this->getDoctrine()->getManager();
            $acquirementTypesCollection = $em->getRepository(AcquirementType::class)->findAll();
            $acquirementTypes           = [];
            foreach ($acquirementTypesCollection as $acquirementType) {
                $acquirementTypes[] = [
                    'id'         => $acquirementType->getId(),
                    'name'       => $acquirementType->getName(),
                    'identifier' => $acquirementType->getIdentifier(),
    
                ];
            }
            $response = new JsonResponse($acquirementTypes);
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