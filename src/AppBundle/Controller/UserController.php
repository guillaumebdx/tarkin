<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;

class UserController extends Controller
{


    /**
     * Retrieve Users
     *
     * @Rest\View()
     * @Rest\Get("/api/users")
     */
    public function getUserListAction(Request $request)
    {
        try {
            $em             = $this->getDoctrine()->getManager();
            $userCollection = $em->getRepository(User::class)->findAll();
            $users          = [];
            foreach ($userCollection as $user) {
                $users[] = [
                    'id'    => $user->getId(),
                    'name'  => $user->getNameReference(),
                    'email' => $user->getEmail(),
                    
                ];
            }
                       
            return new JsonResponse($users);
        } catch (\Exception $exception) {
            return new Response(
                'Problème d\'appel à l\'API ' . $exception,
                Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
        
    }
    
    
    
}