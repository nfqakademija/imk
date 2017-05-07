<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $searchInput = $request->query->get('tag');
        $result = $this->getDoctrine()->getRepository('AppBundle:Category')->searchByTitle($searchInput);

        return new JsonResponse(array_map(function (Category $category) {
            return $category->getTitle();
        }, $result
        ));
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
