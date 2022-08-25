<?php

namespace App\Controller\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    #[Route('/profile/user/profile', name: 'app_profile_user_profile')]
    public function index(): Response
    {
        return $this->render('profile/user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
        ]);
    }
}
