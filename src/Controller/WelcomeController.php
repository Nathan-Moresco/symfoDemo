<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateAccountType;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function indexAction(Request $request): Response
    {
        // $current_user = $this->getUser();

        return $this->render('welcome.html.twig', []);
    }

    #[Route('/login', name: 'login')]
    public function loginAction(Request $request, EntityManagerInterface $entityManager, TranslatorInterface $t, UserPasswordHasherInterface $passwordHasher, Security $security): Response
    {
        $error_msg = null;
        $current_user = $this->getUser();
        if($current_user !== null) {
            return $this->redirectToRoute("account");
        }

        $login_form = $this->createForm(LoginType::class);
        $register_form = $this->createForm(CreateAccountType::class);

        $login_form->handleRequest($request);
        $register_form->handleRequest($request);

        if($login_form->isSubmitted() && $login_form->isValid()) {
            $target_user = $entityManager->getRepository(User::class)->findOneBy(['email' => $login_form->get('email')->getData()]);
            if($target_user) {
                $security->login($target_user);

                return $this->redirectToRoute('account');
            } else {
                $error_msg = $t->trans("Identifiants incorrects");
            }
            
        }

        if($register_form->isSubmitted() && $register_form->isValid()) {
            $target_user = $entityManager->getRepository(User::class)->findOneBy(['email' => $register_form->get('email')->getData()]);
            if($target_user) {
                $error_msg = $t->trans("Compte déjà existant");
            } else {
                $user = new User();
                $user->setEmail($register_form->get('email')->getData());
                $hashedPassword = $passwordHasher->hashPassword($user, $register_form->get('password')->getData());
                $user->setPassword($hashedPassword);
                $entityManager->persist($user);
                $entityManager->flush();

                $security->login($user);

                return $this->redirectToRoute('account');
            }
        }

        return $this->render('login.html.twig', [
            "login_form" => $login_form,
            "register_form" => $register_form,
            "error_msg" => $error_msg
        ]);
    }

     #[Route('/account', name: 'account')]
    public function accountAction(Request $request): Response
    {
        if($this->getUser() === null) {
            return $this->redirectToRoute("login");
        }

        return $this->render('account.html.twig', []);
    }

    #[Route('/logout', name: 'logout')]
    public function logoutAction(Security $security): Response
    {
        $response = $security->logout();
        return $this->redirectToRoute('index');
    }
}