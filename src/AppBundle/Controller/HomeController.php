<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        //action for voting for selected decision post
        //When voting icon is clicked, the vote counter is incremented by 1
        //therefore no twig template is used

        $response = new JsonResponse();
        $response->setData([
            'decisionId' => $decisionId,
            'contentId' => $contentId,
            'status' => 'success'
        ]);

        return $response;
    }
}
