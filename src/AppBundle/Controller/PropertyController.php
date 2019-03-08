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
use AppBundle\Entity\LawPosition;
use AppBundle\Entity\FamilyPosition;
use AppBundle\Service\InheritManager\InheritService;
use AppBundle\Entity\Beneficiary;

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
                $acquirement = null;
                if (null !== $property->getAcquirementTypes()) {
                    $acquirement = $property->getAcquirementTypes()->getName();
                }
                $properties[] = [
                    'id'                     => $property->getId(),
                    'name'                   => $property->getName(),
                    'value'                  => $property->getValue(),
                    'returnRate'             => $property->getReturnRate(),
                    'identifier_type'        => $property->getPropertyTypes()->getIdentifier(),
                    'type'                   => $property->getPropertyTypes()->getName(),
                    'acquirement_identifier' => $property->getAcquirementTypes()->getIdentifier(),
                    'acquirement'            => $acquirement,
                    'financial'              => $property->getPropertyTypes()->getFinancial(),
                    'feelingValue'           => $property->getFeeling(),
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
     * Retrieve properties for a user (family)
     *
     * @Rest\View()
     * @Rest\Get("/api/user/{userId}/properties")
     */
    public function getPropertiesByUserAction(Request $request)
    {
        try {
            $em                   = $this->getDoctrine()->getManager();
            $user                 = $em->getRepository(User::class)->find($request->get('userId'));
            $properties           = [];
            foreach ($user->getPhysicalPersons() as $physicalPerson) {
                $propertiesCollection = $em->getRepository(Property::class)->findByPhysicalPerson($physicalPerson);
                foreach ($propertiesCollection as $property) {
                    $acquirement           = null;
                    $acquirementIdentifier = null;
                    if (null !== $property->getAcquirementTypes()) {
                        $acquirement           = $property->getAcquirementTypes()->getName();
                        $acquirementIdentifier = $property->getAcquirementTypes()->getIdentifier();
                    }
                    $shareWith = null;
                    if ($property->isShared() === true) {
                        $shareWith = $property->getShareWith()->getId();
                    }
                    $properties[] = [
                        'id'                      => $property->getId(),
                        'name'                    => $property->getName(),
                        'value'                   => $property->getValue(),
                        'returnRate'              => $property->getReturnRate(),
                        'identifier_type'         => $property->getPropertyTypes()->getIdentifier(),
                        'type'                    => $property->getPropertyTypes()->getName(),
                        'acquirement_identifier'  => $acquirementIdentifier,
                        'acquirement'             => $acquirement,
                        'physicalPersonId'        => $physicalPerson->getId(),
                        'physicalPersonFirstName' => $physicalPerson->getFirstName(),
                        'isFinancial'             => $property->getPropertyTypes()->getFinancial(),
                        'isShared'                => $property->isShared(),
                        'shareWith'               => $shareWith,
                        'feelingValue'            => $property->getFeeling(),
                    ];
                }
            }
            
            $response = new JsonResponse($properties);
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
     * @Rest\RequestParam(name="acquirementTypeId", nullable=true)
     * @Rest\RequestParam(name="acquirementDate")
     * @Rest\RequestParam(name="feelingValue")
     * 
     * @Rest\Post("/api/new-property")
     */
    public function createPropertyAction(Request $request, ParamFetcherInterface $paramFetcher, InheritService $inheritService)
    {
        $em                = $this->getDoctrine()->getManager();
        $personId          = $paramFetcher->get('personId');
        $name              = $paramFetcher->get('name');
        $value             = $paramFetcher->get('value');
        $returnRate        = $paramFetcher->get('returnRate');
        $propertyTypeId    = $paramFetcher->get('propertyTypeId');
        $acquirementTypeId = $paramFetcher->get('acquirementTypeId');
        $acquirementDate   = $paramFetcher->get('acquirementDate');
        $feelingValue      = $paramFetcher->get('feelingValue');
        
        $person       = $em->getRepository(PhysicalPerson::class)->find($personId);
        $propertyType = $em->getRepository(PropertyType::class)->find($propertyTypeId);

        $spouse = null;
        $personCollections = $em->getRepository(PhysicalPerson::class)->findBy(['user' => $person->getUser()->getId()]);
        foreach($personCollections as $personIterate) {
            if ($personIterate->getCradle() !== $person->getCradle() && $personIterate->getFamilyPosition()->getIdentifier() === FamilyPosition::conjoint) {
                $spouse = $personIterate;
            }
        }
        if ($acquirementTypeId) {
            $acquirementType = $em->getRepository(AcquirementType::class)->find($acquirementTypeId);
            if(
                $person->getLawPosition()->getIdentifier() === LawPosition::commonCommunity 
                && $acquirementType->getIdentifier() === AcquirementType::duringMarriage
                && $propertyType->getIdentifier() !== PropertyType::lifeInsurance
                ) {
                $value = $value /2;
                $property2 = new Property();
                $property2->setName($name);
                $property2->setValue($value);
                $property2->setReturnRate($returnRate);
                $property2->addPhysicalPerson($spouse);
                $property2->setPropertyTypes($propertyType);
                $property2->setAcquirementTypes($acquirementType);
                $property2->setAcquirementDate(new \DateTime($acquirementDate));
                $property2->setFeeling($feelingValue);
            }
        } else if($person->getLawPosition()->getIdentifier() === LawPosition::universalCommunity && $propertyType->getIdentifier() !== PropertyType::lifeInsurance) {
            $value = $value /2;
            $property2 = new Property();
            $property2->setName($name);
            $property2->setValue($value);
            $property2->setReturnRate($returnRate);
            $property2->addPhysicalPerson($spouse);
            $property2->setPropertyTypes($propertyType);
            $property2->setAcquirementTypes($acquirementType);
            $property2->setAcquirementDate(new \DateTime($acquirementDate));
            $property2->setFeeling($feelingValue);
        }
        
        $property = new Property();
        $property->setName($name);
        $property->setValue($value);
        $property->setReturnRate($returnRate);
        
        $property->addPhysicalPerson($person);
        
        $property->setPropertyTypes($propertyType);
        if ($acquirementTypeId) {
            $property->setAcquirementTypes($acquirementType);
        }
        $property->setAcquirementDate(new \DateTime($acquirementDate));
        $property->setFeeling($feelingValue);
        if (isset($property2)) {
            $property->setShareWith($property2);
            $property2->setShareWith($property);
            $em->persist($property2);
        }
        $children = [];
        $user            = $person->getUser();
        $inheritService->setUser($user);
        if ($propertyType->getIdentifier() === PropertyType::lifeInsurance) {
            if ($inheritService->isMarried()) {
                $beneficiary = new Beneficiary();
                $beneficiary->setProperty($property);
                $beneficiary->setAmount($value);
                $beneficiary->setPhysicalPerson($spouse);
                $em->persist($beneficiary);
            } else {
                $children = $inheritService->getChildren();
            }
        }
        foreach ($children as $child) {
            $beneficiary = new Beneficiary();
            $beneficiary->setProperty($property);
            $beneficiary->setAmount($value / count($children));
            $beneficiary->setPhysicalPerson($child);
            $em->persist($beneficiary);
        }

         $em->persist($property);
        
         $em->flush();
     
        
        return new JsonResponse( $name . ' a bien été créé');
    }
    
    
    
}