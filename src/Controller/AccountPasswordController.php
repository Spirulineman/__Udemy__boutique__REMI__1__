<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    #[Route('/compte/password', name: 'account_password')]

    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_password = $form->get('old_password')->getData();

            if ($encoder->isPasswordValid($user, $old_password)) {
                $new_password = $form->get('new_password')->getData();
                $password = $encoder->encodePassword($user, $new_password);

                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $notification = "Votre mot de passe a bien été modifié";
            }
            else{
                $notification = "Votre mot de passe actuel ne correspond pas";
            }
        }
        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
