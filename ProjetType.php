<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\ProjetTag;
use App\Entity\ImageProjet;
use App\Form\ImageProjetType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('sousTitre')
            ->add('resume', TextareaType::class)
            ->add('texte', TextareaType::class,  ['attr' => ['class' => 'ckeditor']])
            ->add('lien')
            ->add('categorie')
            ->add('tag', EntityType::class, [
                'class' => ProjetTag::class,
                'multiple' => true,
                'expanded' => true,
                ])
            ->add('url')
            ->add('actif')
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'image à la une',
                ])
            ->add('imageSlider', CollectionType::class,
            [
                'entry_type' => ImageProjetType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'label' => false,
                'prototype' => true,
                'allow_delete' => true,
                'by_reference' => false,
                
                

                
            ]
            
            )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
