<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "Adresse e-mail",
                'attr' => ["class" => "common-input mb-2"/*, "placeholder" => "Adresse e-mail"*/],
                'label_attr' => ["class" => "text-light"]
            ])
            ->add('password', PasswordType::class, [
                'label' => "Mot de passe",
                'attr' => ["class" => "common-input mb-2"/*, "placeholder" => "Mot de passe"*/],
                'label_attr' => ["class" => "text-light"]
            ])
        ;
    }
}