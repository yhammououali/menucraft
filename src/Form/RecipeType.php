<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la recette',
                'attr' => ['class' => 'form-control']
            ])
            ->add('preparationTime', IntegerType::class, [
                'label' => 'Temps de préparation (minutes)',
                'attr' => ['class' => 'form-control']
            ])
            ->add('difficulty', TextType::class, [
                'label' => 'Difficulté',
                'attr' => ['class' => 'form-control']
            ])
            ->add('steps', TextareaType::class, [
                'label' => 'Étapes',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 10,
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => $options['is_edit'] ?? false ? 'Mettre à jour la recette' : 'Créer la recette',
                'attr' => ['class' => 'btn btn-primary mt-3']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
            'is_edit' => false,
        ]);
    }
}
