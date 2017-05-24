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
     * @Route("/view/{id}", name="view", requirements={"id": "\d+"})
     */
    public function viewAction($id)
    {
        $poll = $this->getDoctrine()->getRepository('AppBundle:Poll')->find($id);
        return $this->render('AppBundle:Home:singlePost.html.twig', [
            'poll' => $poll
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
        $pollsArray = array_map(function (array $poll) {
            return $poll['title'];
        }, $polls);

        $result = array_merge($tagsArray, $pollsArray);

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
        $optionId = $request->request->get('optionId');
        $pollId = $request->request->get('pollId');
        $userAgent = $request->headers->get('User-Agent');
        $userIp = $request->getClientIp();

        $voter = $this->get('app.voter');
        $status = $voter->vote($pollId, $optionId, $userIp, $userAgent);

        if (!$status['success']) {
            return $response = new JsonResponse([
                'success' => false,
                'error' => $status['error']
            ]);
        }

        return $response = new JsonResponse([
            'success' => true,
            'voteCount' => $status['voteCount']
        ]);
    }
}
