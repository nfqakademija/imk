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

        if (!$polls) {
            return $this->render('AppBundle:Home:index.html.twig', [
                'polls' => $polls,
                'error' => 'Looks like there are no posts yet.'
            ]);
        }

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
        $polls = $this->getDoctrine()->getRepository('AppBundle:Poll')->searchByCategoryOrPollName($searchInput);
        if (!$polls) {
            return $this->render('AppBundle:Home:index.html.twig', [
                'polls' => $polls,
                'error' => 'Sorry! No entries were found :('
            ]);
        }
        return $this->render('AppBundle:Home:index.html.twig', [
            'polls' => $polls
        ]);
    }

    /**
     * @Route("/searchAutoComplete", name="searchAutoComplete")
     */
    public function searchAutoCompleteAction(Request $request)
    {
        $searchInput = $request->query->get('tag');
        $tags = $this->getDoctrine()->getRepository('AppBundle:Category')->searchByTitle($searchInput);
        $polls = $this->getDoctrine()->getRepository('AppBundle:Poll')->searchByTitle($searchInput);
        $tagsArray = array_map(function (Category $category) {
            return $category->getTitle();
        }, $tags);
        $pollsArray = array_map(function (Array $poll) {
            return $poll['title'];
        }, $polls);

        $result = array_merge($tagsArray,$pollsArray);
        return new JsonResponse($result);
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
     * @Route("/vote", name="vote")
     */
    public function voteAction(Request $request)
    {
        //TODO: restrinct voting by 1 vote per user

        $optionId = $request->request->get('optionId');
        if (!$optionId) {
            return $response = new JsonResponse([
                'status' => false,
                'error' => 'No data received.'
            ]);
        }
        $option = $this->getDoctrine()->getManager()->getRepository('AppBundle:PollOption')->find($optionId);
        if (!$option) {
            return $response = new JsonResponse([
                'status' => false,
                'error' => 'Vote option not found.'
            ]);
        }

        $voteCount = $option->incrementVoteCount();

        $this->getDoctrine()->getManager()->flush();
        return $response = new JsonResponse([
            'success' => true,
            'voteCount' => $voteCount
        ]);

    }
}
