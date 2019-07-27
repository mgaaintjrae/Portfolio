<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ProjectType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                array('label' => 'Nom')
            )
            ->add(
                'created_date',                
                DateTimeType::class,
                array('label' => 'Date de création')

            )
            ->add(
                'add_at',
                DateTimeType::class,
                array('label' => 'Date d\'ajout')

            )
            ->add(
                'category',
                TextType::class,
                array('label' => 'Catégorie')

            )
            ->add(
                'description',
                TextType::class,
                array('label' => 'Description du projet')

            )
            ->add(
                'technology',
                TextType::class,
                array('label' => 'Technologies utilisées')

            )
            ->add(
                'customer',
                TextType::class,
                array('label' => 'Client')

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
