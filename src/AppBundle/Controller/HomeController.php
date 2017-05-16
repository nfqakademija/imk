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
        $polls = $this->getDoctrine()->getRepository('AppBundle:Poll')->findAll();

        return $this->render('AppBundle:Home:index.html.twig', [
            'polls' => $polls
        ]);
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
     * @Route("/submit", name="submit")
     */
    public function newPostAction()
    {



        return $this->render(':inc:new_post_form.html.twig', [

        ]);
    }
    /**
     * @Route("/submit/process", name="submit_process")
     */
    public function submitProcessAction(Request $request)
    {
        $title = $request->request->get('title');
        $categoryNames = $request->request->get('category');
        $files = $request->files->get('file');

        $uploader = $this->get('app.postuploader');
        $uploader->insert($title, $files, $categoryNames);

        return new JsonResponse([]);
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
