<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeIndexController extends AbstractController
{
    #[Route('/delete', name: 'app_home_index')]
    public function index(): Response
    {
        if ($this->getUser() && in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)) {
            return $this->render('home_index/index.html.twig', [
                'controller_name' => 'HomeIndexController',
            ]);
        }
         else {
            return $this->redirect('https://google.com/');
        }
    }
}
