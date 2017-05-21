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
        // Decision creation form
        return $this->render('AppBundle:Decisions:new_decision.html.twig', [// ...
        ]);
    }
}
