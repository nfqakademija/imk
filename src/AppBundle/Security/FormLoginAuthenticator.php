<?php

namespace AppBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FormLoginAuthenticator extends AbstractFormLoginAuthenticator
{
    private $em;
    private $router;
    private $passwordEncoder;

    public function __construct(EntityManager $em, RouterInterface $router, UserPasswordEncoder $passwordEncoder)
    {
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getCredentials(Request $request)
    {
// if getCredentials() returns null, the authenticator is skipped.
        if ($request->getPathInfo() != '/login' || !$request->isMethod('POST')) {
            return null;
        }

        $username = $request->request->get('_userName');
        $request->getSession()->set(Security::LAST_USERNAME, $username);
        $password = $request->request->get('_password');

        return array(
            'username' => $username,
            'password' => $password
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username'];

        $user = $this->em->getRepository('AppBundle:User')->findOneBy(['email' => $username]);

        if (!$user) {
            throw new BadCredentialsException();
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $plainPassword = $credentials['password'];

        if ($this->passwordEncoder->isPasswordValid($user, $plainPassword)) {
            return true;
        }

        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(
                ['message' => $exception->getMessageKey()],
                403
            );
        }

        // for non-AJAX requests, return the normal redirect
        return parent::onAuthenticationFailure($request, $exception);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse();
        }

        // for non-AJAX requests, return the normal redirect
        return parent::onAuthenticationSuccess($request, $token, $providerKey);
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('homepage');
    }
}
