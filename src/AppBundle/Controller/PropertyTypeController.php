<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\PropertyType;

class PropertyTypeController extends Controller
{


    /**
     * Retrieve financial property type list
     *
     * @Rest\View()
     * @Rest\Get("/api/properties/financial")
     */
    public function getFinancialPropertyTypeListAction(Request $request)
    {
        try {
            $em                 = $this->getDoctrine()->getManager();
            $propertyCollection = $em->getRepository(PropertyType::class)->findBy(array('financial'=>true));
            $properties         = [];
            foreach ($propertyCollection as $property) {
                $properties[] = [
                    'id'         => $property->getId(),
                    'name'       => $property->getName(),
                    'identifier' => $property->getIdentifier(),
                    
                ];
            }
            $response = new JsonResponse($properties);
            $response->headers->set('Access-Control-Allow-Origin', '*');
                       
            return $response;
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API ' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
    
    /**
     * Retrieve real estate property type list
     *
     * @Rest\View()
     * @Rest\Get("/api/properties/realestate")
     */
    public function getRealestatePropertyTypeListAction(Request $request)
    {
        try {
            $em                 = $this->getDoctrine()->getManager();
            $propertyCollection = $em->getRepository(PropertyType::class)->findBy(array('financial'=>false));
            $properties         = [];
            foreach ($propertyCollection as $property) {
                $properties[] = [
                    'id'         => $property->getId(),
                    'name'       => $property->getName(),
                    'identifier' => $property->getIdentifier(),
                    
                ];
            }
            $response = new JsonResponse($properties);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API ' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
    
    
    
}