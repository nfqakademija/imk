<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register", condition="request.isXmlHttpRequest()")
     * @Method({"POST"})
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(UserRegistrationForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $user->setCreateDate(time());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('app.form_login_authenticator'),
                    'main' // the name of your firewall
                );
        }

//// a FormErrorIterator instance, but only errors attached to this
//// form level (e.g. "global errors)
//        $errors = $form->getErrors();
//
//// a FormErrorIterator instance, but only errors attached to the
//// "firstName" field
//        $errors = $form['firstName']->getErrors();
//
//// a FormErrorIterator instance in a flattened structure
//// use getOrigin() to determine the form causing the error
//        $errors = $form->getErrors(true);
//
//// a FormErrorIterator instance representing the form tree structure
//        $errors = $form->getErrors(true, false);

        $errorMessage = $form->getErrors(true)->current()->getMessage();
        return new JsonResponse(['message' => $errorMessage], 400);
    }

    /**
     * @Route("/social_login", name="social_login", condition="request.isXmlHttpRequest()")
     * @Method({"POST"})
     */
    public function socialLoginAction(Request $request)
    {
        $form = $this->createFormBuilder(null, ['csrf_protection' => false, 'allow_extra_fields' => true])
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 32]),
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 64]),
                    new Email()
                ]
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'format' => 'MM/dd/yyyy',
                'html5' => false])
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Male' => 'male',
                    'Female' => 'female'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('AppBundle:User')
                ->findOneBy(['email' => $data['email']]);

            if (!$user) { // user is not in db, register
                /** @var User $user */
                $user = new User();
                $user->setUserName($data['name']);
                $user->setEmail($data['email']);
                $user->setBirthDate($data['birthday']);
                $user->setGender($data['gender']);
                $user->setCreateDate(time());
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('app.social_login_authenticator'),
                    'main' // the name of your firewall
                );
        } else {
            $errorMessage = $form->getErrors(true)->current()->getMessage();
            return new JsonResponse(['message' => $errorMessage], 400);
        }
    }
}
