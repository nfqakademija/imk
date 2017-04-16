<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
        return $this->render('AppBundle:Admin:index.html.twig', [
            // ...
        ]);
    }

    /**
     * @Route("/edit", name="admin_user_index")
     */
    public function userIndexAction()
    {
        // Admin panel: user editing panel
        // Form to change the following user data:
        // password, email...
        return $this->render('AppBundle:Admin:edit_user_index.html.twig', [

        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_user_edit")
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
     * @Route("/disable/{id}", name="admin_user_disable")
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
        return $this->render('AppBundle:Admin:posts_index.html.twig', [

        ]);
    }

    /**
     * @Route("/remove/{id}", name="admin_post_remove")
     */
    public function removePostAction($id)
    {
        // Admin panel: post (Decision) removal interface
        return $this->render('AppBundle:Admin:remove_post.html.twig', [
            'id' => $id
        ]);
    }

}
