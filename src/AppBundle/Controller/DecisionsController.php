<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DecisionsController extends Controller
{
    /**
     * @Route("/new")
     */
    public function newDecisionAction()
    {
        //Naujas decision'o kurimas
        return $this->render('AppBundle:Decisions:new_decision.html.twig', array(// ...
        ));
    }

}
