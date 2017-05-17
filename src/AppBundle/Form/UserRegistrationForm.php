<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserRegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
// When mapping forms to objects, all fields are mapped.
// Any fields on the form that do not exist on the mapped object will cause an exception to be thrown.
// Additionally, if there are any fields on the form that aren't included in the submitted data, those fields will be explicitly set to null.
        $builder
            ->add('userName') // guess type from the User class. The "guessing" is activated when you omit the second argument to the add() method (or if you pass null to it).
            ->add('email',EmailType::class)
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'first_name'  => 'password',
                'second_name' => 'confirm'])
            ->add('birthDate', BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => false])
            ->add('gender', TextType::class)
            ->add('termsAccepted', CheckboxType::class, [
                'mapped' => false, // will not be mapped to the underlying object
                'constraints' => new IsTrue(['message' => 'You must accept the terms.'])]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class, // Thanks to the data_class option, the form creates a new Entity object behind the scenes. And then it sets the data on it.
            'validation_groups' => ['Default', 'Registration'],
            'csrf_protection' => false
        ]);
    }
}
