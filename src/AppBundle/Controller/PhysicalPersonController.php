<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\PhysicalPerson;
use AppBundle\Entity\User;


class PhysicalPersonController extends Controller
{


    /**
     * Retrieve physical persons for a user
     *
     * @Rest\View()
     * @Rest\Get("/api/user/{userId}/physical-persons")
     */
    public function getPhysicalPersonsAction(Request $request)
    {
        try {
            $em                        = $this->getDoctrine()->getManager();
            $user                      = $em->getRepository(User::class)->find($request->get('userId'));
            $physicalPersonsCollection = $em->getRepository(PhysicalPerson::class)->findBy(['user' => $user]);
            $physicalPersons           = [];
            foreach ($physicalPersonsCollection as $physicalPerson) {
                $physicalPersons[] = [
                    'id'              => $physicalPerson->getId(),
                    'first_name'      => $physicalPerson->getFirstName(),
                    'name'            => $physicalPerson->getName(),
                    'family_position' => $physicalPerson->getFamilyPosition()->getName(),
                    'cradle'          => $physicalPerson->isCradle(),
                    'birth_date'      => $physicalPerson->getBirthDate()->format('Y/m/d'),
                ];
            }
                       
            return new JsonResponse($physicalPersons);
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API <pre>' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
        
    }
    
    
    
}