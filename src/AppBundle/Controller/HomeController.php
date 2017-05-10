<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Poll;
use AppBundle\Entity\PollCategory;
use AppBundle\Entity\PollOption;
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
    public function submitProccessAction(Request $request)
    {
        $sequence = 1;
        $em = $this->getDoctrine()->getManager();
        $poll = new Poll();
        $category = new Category();
        $joinTable = new PollCategory();

        //Get post data
        $title = $request->request->get('title');
        $categoryNames = $request->request->get('category');
        $files = $request->files->get('file');

        if (!empty($title) and !empty($files) and !empty($categoryNames)){
            //persist catetegory/tag
            $category->setTitle($categoryNames);
            $joinTable->setPollId($poll);
            $joinTable->setCategoryId($category);
            $em->persist($category);
            $em->persist($joinTable);

            $poll->setTitle($title);

            //save all received files
            foreach ($files as $file){
                $option = new PollOption();
                $fileName = $this->get('app.fileUploader')->upload($file);
                //save to db
                $option->setContent($fileName);
                $option->setSequence($sequence);
                $option->setPollId($poll);
                $em->persist($option);
                $sequence +=1;
            }
            $em->persist($poll);
            $em->flush();
        }

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
