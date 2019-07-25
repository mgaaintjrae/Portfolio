<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                [
                    'label' => 'Nom'
                ]
            )
            ->add(
                'created_date',
                [
                    'label' => 'Date de création'
                ]
            )
            ->add(
                'add_at',
                [
                    'label' => 'Date d\'ajout'
                ]
            )
            ->add(
                'category',
                [
                    'label' => 'Catégorie'
                ]
            )
            ->add(
                'description',
                [
                    'label' => 'Description du projet'
                ]
            )
            ->add(
                'technology',
                [
                    'label' => 'Technologies utilisées'
                ]
            )
            ->add(
                'customer',
                [
                    'label' => 'Client'
                ]
            )
            ->add(
                'ajouter',
                SubmitType::class,
                [
                    'label' => 'Ajouter',
                    'attr'  => [
                        'class'  => 'button'
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
