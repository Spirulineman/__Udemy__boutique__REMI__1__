<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\LengthValidator;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('Nom', TextType::class, [
                'label'=> 'Votre Nom',
                'constraints' => new Length([
                    'min' => 2,
                'max' => 50
                ]),
                'attr' => [
                   'placeholder'=> 'Dupont, Durand, ...'
                    ]
            ])
            ->add('prenom', TextType::class, [
                'label'=> 'Votre Prénom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 50
                ]),
                'attr' => [
                   'placeholder'=> 'Balthazar, Rudegonde, ...'
                ]
                    ])        
            ->add('email', EmailType::class, [
                'label'=> 'Votre Email',
                'attr' => [
                   'placeholder'=> 'exemple@votredomaine.quelquechose'
                ]
                    ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'required' => true,
                'first_options' => [
                'label' => 'Mot de Passe',
                'attr' => [
                    'placeholder' => '1Mot2P@sseCompLiKé'
                ]
                ],
                'second_options' => ['label' => 'Confirmez votre mot de passe']
            ])

            /* ->add('password_Confirm', PasswordType::class, [
                'label' => 'Vérification de votre mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Retapez votre Mot de Passe'
                ]
            ]) */

            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
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
