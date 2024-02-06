<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffectationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('utilisateurs', EntityType::class, [
                'class' => User::class,
                'label' => 'Utilisateurs',
                'choice_label' => 'username', // Changez ceci selon le champ à afficher pour les utilisateurs
                'multiple' => true, // Autoriser les choix multiples
                 // Afficher comme des cases à cocher
                'required' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.roles LIKE :role')
                        ->setParameter('role', '%"ROLE_ETUDIANT"%');
                }
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'label' => 'Classe',
                'choice_label' => 'designationClasse', // Changez ceci selon le champ à afficher pour les classes
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Affecter',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
