<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Home:index.html.twig', []);
    }

    /**
     * @Route("/vote/{decisionId}/{contentId}", name="vote")
     */
    public function voteAction($decisionId, $contentId)
    {
        //balsavimas uz kazkuri is decision
        //template'o nera, nes naujas puslapis neatsidarys
        //ir tiesiog +1 balsa priskaiciuos?
        return new Response('Balsuojam uz decision nr. : ' . $decisionId .
            '. Pasirinktas ' . $contentId . ' variantas'
        );
    }
}
