<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authUtils): Response
    {
        //pegar o erro do login caso exista
        $erro = $authUtils->getLastAuthenticationError();

        //pegar o ultimo email informado pelo usuario
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'erro' => $erro,
            'lastUsername'=> $lastUsername
        ]);
    }
}
