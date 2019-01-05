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
use FOS\RestBundle\Request\ParamFetcherInterface;
use AppBundle\Entity\User;
use AppBundle\Entity\PropertyType;
use AppBundle\Entity\AcquirementType;


class PropertyController extends Controller
{


    /**
     * Retrieve properties for a physical person
     *
     * @Rest\View()
     * @Rest\Get("/api/person/{physicalPersonId}/properties")
     */
    public function getPropertiesAction(Request $request)
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
                    'financial'              => $property->getPropertyTypes()->getFinancial(),
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
     * Calculate properties sum for a family
     *
     * @Rest\View()
     * @Rest\Get("/api/user/{userId}/properties/sum")
     */
    public function getSumByPropertiesAction(Request $request)
    {
        try {
             $em   = $this->getDoctrine()->getManager();
             $user = $em->getRepository(User::class)->find($request->get('userId'));
             $physicalPersonsCollection = $em->getRepository(PhysicalPerson::class)->findBy(['user' => $user]);
             $realEstate = 0;
             $financial  = 0;
             foreach ($physicalPersonsCollection as $physicalPerson) {
                 $propertiesCollection = $em->getRepository(Property::class)->findByPhysicalPerson($physicalPerson);
                 foreach ($propertiesCollection as $property) {
                     if ($property->getPropertyTypes()->getFinancial()) {
                         $financial += $property->getValue();
                     }
                     if (!$property->getPropertyTypes()->getFinancial()) {
                         $realEstate += $property->getValue();
                     }
                 }
                 
             }

            $propertiesSum = [
                'realEstate' => $realEstate,
                'financial'  => $financial,
            ];
            $response = new JsonResponse($propertiesSum);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
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
     * @Rest\Get("/api/property/{propertyId}/persons")
     */
    public function getPhysicalPersonsAction(Request $request)
    {
        try {
            $em                = $this->getDoctrine()->getManager();
            $property          = $em->getRepository(Property::class)->find($request->get('propertyId'));
            $personsCollection = $em->getRepository(PhysicalPerson::class)->findByProperty($property);
            $persons           = [];
            foreach ($personsCollection as $person) {
                $persons[] = [
                    'id' => $person->getId(),
                ];
            }
            
            return new JsonResponse($persons);
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API <pre>' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }    
    }
    
    /**
     * 
     * @Rest\View()
     * @Rest\RequestParam(name="personId")
     * @Rest\RequestParam(name="name")
     * @Rest\RequestParam(name="value")
     * @Rest\RequestParam(name="returnRate")
     * @Rest\RequestParam(name="propertyTypeId")
     * @Rest\RequestParam(name="acquirementTypeId")
     * @Rest\RequestParam(name="acquirementDate")
     * 
     * @Rest\Post("/api/new-property")
     */
    public function createPropertyAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $em                = $this->getDoctrine()->getManager();
        $personId          = $paramFetcher->get('personId');
        $name              = $paramFetcher->get('name');
        $value             = $paramFetcher->get('value');
        $returnRate        = $paramFetcher->get('returnRate');
        $propertyTypeId    = $paramFetcher->get('propertyTypeId');
        $acquirementTypeId = $paramFetcher->get('acquirementTypeId');
        $acquirementDate   = $paramFetcher->get('acquirementDate');
        
        $property = new Property();
        $property->setName($name);
        $property->setValue($value);
        $property->setReturnRate($returnRate);
        $person = $em->getRepository(PhysicalPerson::class)->find($personId);
        $property->addPhysicalPerson($person);
        $propertyType = $em->getRepository(PropertyType::class)->find($propertyTypeId);
        $property->setPropertyTypes($propertyType);
        $acquirementType = $em->getRepository(AcquirementType::class)->find($acquirementTypeId);
        $property->setAcquirementTypes($acquirementType);
        $property->setAcquirementDate(new \DateTime($acquirementDate));

         $em->persist($property);
         $em->flush();
     
        
        return new JsonResponse( $name . ' a bien été créé');
    }
    
    
    
}