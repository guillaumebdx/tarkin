<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\PhysicalPerson;
use AppBundle\Entity\PriorityType;
use AppBundle\Entity\User;

class PriorityController extends Controller
{


    /**
     * Retrieve properties for a physical person
     *
     * @Rest\View()
     * @Rest\Get("/api/user/{userId}/priorities")
     */
    public function getCradlePrioritiesAction(Request $request)
    {
        try {
            $em                        = $this->getDoctrine()->getManager();
            $user                      = $em->getRepository(User::class)->find($request->get('userId'));
            $physicalPersonsCollection = $em->getRepository(PhysicalPerson::class)->findBy(['user' => $user]);
            $priorities                = [];
            foreach ($physicalPersonsCollection as $physicalPerson) {
                if ($physicalPerson->isCradle()) {
                    foreach ($physicalPerson->getPriorities() as $priority) {
                        $priorities[] =
                        [
                            'id'                     => $priority->getId(),
                            'value'                  => $priority->getValue(),
                            'priorityTypeId'         => $priority->getPriorityType()->getId(),
                            'priorityTypeIdentifier' => $priority->getPriorityType()->getIdentifier(),
                            'priorityTypeName'       => $priority->getPriorityType()->getName(),
                        ];
                    }
                }
            }
                       
            return new JsonResponse($priorities);
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API <pre>' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }    
    }


}