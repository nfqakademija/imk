<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     * @Method({"POST"})
     */
    public function loginAction()
    {
        // will never be executed
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        // will never be executed
    }
}

