<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use function PHPSTORM_META\type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;

    }
    
    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm( RegisterType::class, $user);

        $form = $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $user = $form->getData();

            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            /* dd($user); */  // ==>> permet de récupérer le dump de la variable $user : RegisterController.php on line 27:
                                                                                        /* App\Entity\User {#354 ▼
                                                                                        -id: null
                                                                                        -email: "mail.1@mail.com"
                                                                                        -roles: []
                                                                                        -password: "eT427Q9nryzJF3q"
                                                                                        -Nom: "Nom_1_"
                                                                                        -Prenom: "Prenom_1_" */
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
