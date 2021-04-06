<?php

namespace App\Form;

use App\Classe\Search;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchType extends AbstractType 
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('string', TextType::class, [
            /* 'label' => 'Rechercher', */
            'required' => false,
            'attr' => [
                'placeholder' => 'Votre recherche ...'
            ]
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'Crsf_protection' => false,
        ]);

    }

    public function getBlockPrefix()
    {
        return '';

    }
}
