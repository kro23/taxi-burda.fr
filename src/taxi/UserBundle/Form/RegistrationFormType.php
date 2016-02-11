<?php
/**
 * Created by PhpStorm.
 * User: kro23
 * Date: 08/02/16
 * Time: 12:02
 */

namespace taxi\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username','attr'=>array('class'=>'form-control'),'translation_domain' => 'FOSUserBundle'))
            ->add('email', EmailType::class , array('label' => 'form.email','attr'=>array('class'=>'form-control'),'translation_domain' => 'FOSUserBundle'))
            ->add('prenom', TextType::class , array('label' => 'Prenom','required' => false,'attr'=>array('class'=>'form-control')))
            ->add('telephone', NumberType::class , array('label' => 'Telephone','attr'=>array('class'=>'form-control')))
            ->add('avatarFile', FileType::class , array('label' => 'avatar','required' => false,))

            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password','attr'=>array('class'=>'form-control')),
                'second_options' => array('label' => 'form.password_confirmation','attr'=>array('class'=>'form-control')),
                'invalid_message' => 'fos_user.password.mismatch'
            ))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }


    public function getBlockPrefix()
    {
        return 'taxi_user_registration';
    }

 /*   public function getName()
    {
        return $this->getBlockPrefix();
    }*/

}