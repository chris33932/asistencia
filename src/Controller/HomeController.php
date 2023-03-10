<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
class HomeController extends AbstractController
{
    #[Route('/algo', name: 'algo')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('home.html.twig', [
            'number' => $number,
        ]);
    }
}