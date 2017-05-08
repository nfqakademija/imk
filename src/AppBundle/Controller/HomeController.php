<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
    public function newPostAction(Request $request)
    {
        $cat = new Category();
        $form = $this->createFormBuilder($cat)
            ->setAction($this->generateUrl('submit'))
            ->setMethod('POST')
            ->add('title', TextType::class)
            ->add('hitsCount', IntegerType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Confirm',
                'attr' => ['class' => 'btn btn-primary']
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cat = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render(':inc:new_post_form.html.twig', [
            'form' => $form->createView(),
        ]);
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
