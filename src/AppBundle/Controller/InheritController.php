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

class InheritController extends Controller
{


    /**
     * Get Inherit Action
     * Retrieve inherits data by physical person for a family
     * @Rest\View()
     * @Rest\Get("/api/inherits/user/{userId}")
     */
    public function getInheritAction(Request $request)
    {
        $em                        = $this->getDoctrine()->getManager();
        $user                      = $em->getRepository(User::class)->find($request->get('userId'));
        $physicalPersonsCollection = $em->getRepository(PhysicalPerson::class)->findBy(['user' => $user]);
        $usufructSpouse            = null;
        $childrenCollection        = [];
        
        
        foreach ($physicalPersonsCollection as $physicalPerson) {
            if($this->_isUsufructSpouse($physicalPerson)) {
                $usufructSpouse = $physicalPerson;
            }
            if ($physicalPerson->getLawPosition()->getIdentifier() === LawPosition::child) {
                $childrenCollection[] = $physicalPerson;
            }
        }
        $nbChildren = count($childrenCollection);
        if ($nbChildren === 0) {
            $this->_retrieveOtherHeirs($physicalPersonsCollection);
        }

        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }

    /**
     * Is Usufruct Spouse
     * 
     * Determinate if a physical person is able to inherit full usufruct
     * 
     * @param PhysicalPerson $physicalPerson
     * @return boolean
     */
    protected function _isUsufructSpouse(PhysicalPerson $physicalPerson)
    {
        $result = false;
        if(
            $physicalPerson->getLawPosition()->getIdentifier()    === LawPosition::commonCommunity
            || $physicalPerson->getLawPosition()->getIdentifier() === LawPosition::movableCommunity
            || $physicalPerson->getLawPosition()->getIdentifier() === LawPosition::separatedProperty
            ) {
                $result = true;
            }
        return $result;
    }

    /**
     * 
     * @param Array $physicalPersonsCollection
     * @return array
     */
    protected function _retrieveOtherHeirs(Array $physicalPersonsCollection)
    {
        $byLawPositionPhysicalPersons = [];
        $spouse                       = null;
        $result                       = [];
        foreach ($physicalPersonsCollection as $physicalPerson) {
            $byLawPositionPhysicalPersons[$physicalPerson->getLawPosition()->getIdentifier()] = $physicalPerson;
        }

        return $result;
    }


}