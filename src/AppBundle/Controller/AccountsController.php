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
        // Login page.
        // Possibly remove this route
        // and replace it with a modal pop-up on the index page?
        return $this->render('AppBundle:Accounts:login.html.twig', [
            // ...
        ]);
    }

    /**
     * @Route("/register")
     */
    public function registerAction()
    {
        // Registration form
        return $this->render('AppBundle:Accounts:register.html.twig', [
            //...
        ]);
    }

}
