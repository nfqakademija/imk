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
        //admin paneles pagrindinis langas
        return $this->render('AppBundle:Admin:index.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/edit/{id}", name="admin_user_edit")
     */
    public function editUserAction($id)
    {
        //naudotojo redagavimas
        return $this->render('AppBundle:Admin:edit_user.html.twig', array(
            'id' => $id
        ));
    }

    /**
     * @Route("/disable/{id}", name="admin_user_disable")
     */
    public function disableUserAction($id)
    {
        //naudotojo paskyros isjungimas
        return $this->render('AppBundle:Admin:disable_user.html.twig', array(
            'id' => $id
        ));
    }

    /**
     * @Route("/remove/{id}", name="admin_post_remove")
     */
    public function removePostAction($id)
    {
        //decision'o istrynimas
        return $this->render('AppBundle:Admin:remove_post.html.twig', array(
            'id' => $id
        ));
    }

}
