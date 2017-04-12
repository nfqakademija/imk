<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccountsController extends Controller
{
    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return $this->render('AppBundle:Accounts:login.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/register")
     */
    public function registerAction()
    {
        return $this->render('AppBundle:Accounts:register.html.twig', array(// ...
        ));
    }

}
