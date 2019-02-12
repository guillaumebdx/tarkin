<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PhysicalPerson;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\LawPosition;
use Doctrine\Common\Collections\Collection;
use AppBundle\Service\InheritManager\InheritService;

class InheritController extends Controller
{


    /**
     * Get Inherit Action
     * Retrieve inherits data by physical person for a family
     * @Rest\View()
     * @Rest\Get("/api/inherits/user/{userId}")
     */
    public function getInheritAction(Request $request, InheritService $inheritService)
    {
        $em              = $this->getDoctrine()->getManager();
        $user            = $em->getRepository(User::class)->find($request->get('userId'));
        $inheritService->setUser($user);
        $inheritService->getHeirs();
        $response = new JsonResponse('ok');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }


}