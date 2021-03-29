<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Votre Email actuel'
            ])
            ->add('Nom', TextType::class, [
                'disabled' => true,
                'label' => 'Votre Nom'
            ])
            ->add('Prenom', TextType::class, [
                'disabled' => true,
                'label' => 'Votre Prénom'
            ])
            ->add('old_password', PasswordType::class, [
                'mapped'=> false,
                'label' => 'mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ]
            ])

            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped'=> false,
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'required' => true,
                'first_options' => [
                    'label' => 'Votre nouveau mot de Passe',
                    'attr' => [
                        'placeholder' => 'Saisissez votre nouveau Mot2P@sseCompLiKé'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de re-saisir votre nouveau mot de passe'
                        ]
                    ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Modifier"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
