<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Module;
use App\Entity\Semestre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomModule')
            ->add('semestre', EntityType::class, [
                'class' => Semestre::class, // Remplacez Semestre::class par le nom de votre classe d'entité Semestre
                'choice_label' => 'numSemestre', // Remplacez 'nomSemestre' par le nom de la propriété à afficher dans le menu déroulant
            ])
            ->add('cours', EntityType::class, [
                'class' => Cours::class, // Remplacez Cours::class par le nom de votre classe d'entité Cours
                'choice_label' => 'nomCours', // Remplacez 'nomCours' par le nom de la propriété à afficher dans le menu déroulant
                'multiple' => true, // si la relation est ManyToMany
                'expanded' => true, // si la relation est ManyToMany et vous souhaitez des cases à cocher au lieu d'un menu déroulant
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
