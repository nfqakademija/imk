<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_home")
     */
    public function indexAction()
    {
        // Admin panel: index page
        $em = $this->getDoctrine()->getRepository('AppBundle:Poll');
        $polls = $em->findBy([], ['createDate' => 'DESC'], 10);
        $pollCount = $em->allPostCount();

        return $this->render('AppBundle:Admin:index.html.twig', [
            'polls' => $polls,
            'pollCount' => $pollCount
        ]);
    }

    /**
     * @Route("/login", name="admin_login")
     */
    public function loginAction()
    {
        // Admin panel: login page
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('AppBundle:Admin:login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/users", name="admin_user_index")
     */
    public function userIndexAction()
    {
        // Admin panel: user editing panel
        // Form to change the following user data:
        // password, email...

        return $this->render('AppBundle:Admin:users_index.html.twig', [

        ]);
    }

    /**
     * @Route("/users/edit/{id}", name="admin_user_edit")
     */
    public function editUserAction($id)
    {
        // Admin panel: user editing panel
        // Selecting the user to edit
        return $this->render('AppBundle:Admin:edit_user_index.html.twig', [
            'id' => $id
        ]);
    }

    /**
     * @Route("/users/disable/{id}", name="admin_user_disable")
     */
    public function disableUserAction($id)
    {
        // Admin panel: interface for disabling rule violating or other users
        return $this->render('AppBundle:Admin:disable_user.html.twig', [
            'id' => $id
        ]);
    }

    /**
     * @Route("/posts", name="admin_posts_index")
     */
    public function postsIndexAction()
    {
        // Admin panel: post (Decision) index page
        $em = $this->getDoctrine()->getRepository('AppBundle:Poll');
        $polls = $em->findBy([], ['createDate' => 'DESC'], 10);

        return $this->render('AppBundle:Admin:posts_index.html.twig', [
            'polls' => $polls
        ]);
    }

    /**
     * @Route("/remove", name="admin_post_remove")
     */
    public function removePostAction(Request $request)
    {
        // Admin panel: post (Decision) removal interface
        $pollId = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Poll');
        $path = $this->getParameter('image_directory').'/';

        if (!$pollId) {
            return new JsonResponse([
                'error' => 'No input data received.'
            ]);
        }

        $poll = $repository->find($pollId);
        if (!$poll) {
            return new JsonResponse([
                'error' => 'Poll with id ' . $pollId . ' not found'
            ]);
        }

        foreach ($poll->getImages() as $image) {
            $imageName = $image->getContent();
            if (file_exists($path.$imageName)) {
                unlink($path.$imageName);
            }

            $em->remove($image);
        }

        $em->remove($poll);
        $em->flush();
        return new JsonResponse([
            'status' => 'Poll '.$pollId.' deleted.'
        ]);
    }
}
