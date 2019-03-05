<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\PriorityType;

class PriorityTypeController extends Controller
{


    /**
     * Retrieve properties for a physical person
     *
     * @Rest\View()
     * @Rest\Get("/api/priorityTypes")
     */
    public function getPropertiesAction(Request $request)
    {
        try {
            $em                     = $this->getDoctrine()->getManager();
            $priorityTypeCollection = $em->getRepository(PriorityType::class)->findAll();
            $priorityTypes          = [];
            foreach ($priorityTypeCollection as $priorityType) {
                $priorityTypes[] = [
                    'id'         => $priorityType->getId(),
                    'name'       => $priorityType->getName(),
                    'identifier' => $priorityType->getIdentifier(),
                ];
            }
                       
            return new JsonResponse($priorityTypes);
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API <pre>' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }    
    }


}