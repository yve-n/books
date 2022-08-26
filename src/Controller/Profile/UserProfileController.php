<?php

namespace App\Controller\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/profile/user/profile', name: 'app_user_')]
class UserProfileController extends AbstractController
{
    #[Route('/profile/user/profile', name: 'profile')]
    public function index(): Response
    {
        return $this->render('profile/user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
        ]);
    }
}
