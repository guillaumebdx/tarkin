<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\PhysicalPerson;
use AppBundle\Entity\Property;
use AppBundle\Entity\User;


class PropertyController extends Controller
{


    /**
     * Retrieve properties for a physical person
     *
     * @Rest\View()
     * @Rest\Get("/api/user/{physicalPersonId}/properties")
     */
    public function getPhysicalPersonsAction(Request $request)
    {
        try {
            $em                   = $this->getDoctrine()->getManager();
            $physicalPerson       = $em->getRepository(PhysicalPerson::class)->find($request->get('physicalPersonId'));
            $propertiesCollection = $em->getRepository(Property::class)->findByPhysicalPerson($physicalPerson);
            $properties           = [];
            foreach ($propertiesCollection as $property) {
                $properties[] = [
                    'id'                     => $property->getId(),
                    'name'                   => $property->getName(),
                    'value'                  => $property->getValue(),
                    'returnRate'             => $property->getReturnRate(),
                    'identifier_type'        => $property->getPropertyTypes()->getIdentifier(),
                    'type'                   => $property->getPropertyTypes()->getName(),
                    'acquirement_identifier' => $property->getAcquirementTypes()->getIdentifier(),
                    'acquirement'            => $property->getAcquirementTypes()->getName(),
                ];
            }
                       
            return new JsonResponse($properties);
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API <pre>' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }    
    }

    /**
     * Retrieve physical persons for a property
     *
     * @Rest\View()
     * @Rest\Get("/api/user/{propertyId}/properties")
     */
    public function getPhysicalPersonsAction(Request $request)
    {
        
    }
    
    
    
}