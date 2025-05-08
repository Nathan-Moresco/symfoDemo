<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateAccountType;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function indexAction(Request $request): Response
    {
        $current_user = $this->getUser();

        return $this->render('welcome.html.twig', [
            'account' => $current_user,
        ]);
    }

    #[Route('/login', name: 'login')]
    public function loginAction(Request $request): Response
    {
        $current_user = $this->getUser();
        if($current_user !== null) {
            return $this->redirectToRoute("account");
        }

        $login_form = $this->createForm(LoginType::class);
        $register_form = $this->createForm(CreateAccountType::class);

        return $this->render('login.html.twig', [
            "login_form" => $login_form,
            "register_form" => $register_form
        ]);
    }

     #[Route('/account', name: 'account')]
    public function accountAction(Request $request): Response
    {
        $current_user = $this->getUser();
        if($current_user === null) {
            return $this->redirectToRoute("login");
        }

        return $this->render('login.html.twig', [
            'account' => $current_user,
        ]);
    }

     #[Route('/create_account', name: 'create_account')]
    public function createUserAction(Request $request): Response
    {
        $current_user = $this->getUser();
        if($current_user !== null) {
            return $this->redirectToRoute("account");
        }

        return $this->render('create_account.html.twig', []);
    }
}