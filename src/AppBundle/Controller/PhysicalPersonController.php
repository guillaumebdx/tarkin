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
use FOS\RestBundle\Request\ParamFetcherInterface;
use AppBundle\Entity\FamilyPosition;
use AppBundle\Entity\LawPosition;


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
                    'law_position'    => $physicalPerson->getLawPosition()->getIdentifier(),
                    'cradle'          => $physicalPerson->isCradle(),
                    'birth_date'      => $physicalPerson->getBirthDate()->format('Y/m/d'),
                    'parents'         => $physicalPerson->getParentIds(),
                ];
            }
            $response = new JsonResponse($physicalPersons);
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
     *
     * @Rest\View()
     * @Rest\RequestParam(name="userId")
     * @Rest\RequestParam(name="firstName")
     * @Rest\RequestParam(name="name")
     * @Rest\RequestParam(name="cradle")
     * @Rest\RequestParam(name="birthDate")
     * @Rest\RequestParam(name="familyPositionId")
     * @Rest\RequestParam(name="parentIds")
     * @Rest\RequestParam(name="lawPositionId")
     *
     * @Rest\Post("/api/new-person")
     */
    public function createPhysicalPersonAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        try {
        $em               = $this->getDoctrine()->getManager();
        $userId           = $paramFetcher->get('userId');
        $firstName        = $paramFetcher->get('firstName');
        $name             = $paramFetcher->get('name');
        $cradle           = $paramFetcher->get('cradle');
        $birthDate        = $paramFetcher->get('birthDate');
        $familyPositionId = $paramFetcher->get('familyPositionId');
        $parentIds        = $paramFetcher->get('parentIds');
        $lawPositionId    = $paramFetcher->get('lawPositionId');
        
        $physicalPerson = new PhysicalPerson();
        $physicalPerson->setFirstName($firstName);
        $physicalPerson->setName($name);
        $physicalPerson->setCradle($cradle);
        $physicalPerson->setBirthDate(new \DateTime($birthDate));
        $user = $em->getRepository(User::class)->find($userId);
        $physicalPerson->setUser($user);
        $familyPosition = $em->getRepository(FamilyPosition::class)->find($familyPositionId);
        $physicalPerson->setFamilyPosition($familyPosition);
        $lawPosition = $em->getRepository(LawPosition::class)->find($lawPositionId);
        $physicalPerson->setLawPosition($lawPosition);
        foreach ($parentIds as $parentId) {
            $parent = $em->getRepository(PhysicalPerson::class)->find($parentId);
            $physicalPerson->addParent($parent);
        }
        
        $em->persist($physicalPerson);
        $em->flush();
        
        
        return new JsonResponse( $name . ' a bien été créé');
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API <pre>' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
    
    
    
}