<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class LoginType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
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
            ->add('submit', SubmitType::class, [
                'label' => $this->translator->trans('Connexion') . '&nbsp;<i class="fa fa-arrow-right-to-bracket"></i>',
                'label_html' => true,
                'attr' => ["class" => "common-button bg-secondary text-primary h-8 mt-4"],
                'row_attr' => ["class" => "flex items-center justify-center mt-2"],
            ])
        ;
    }
}