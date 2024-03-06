<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEvenement')
            ->add('dateEvenement', null, [
                'widget' => 'single_text',
            ])
            ->add('heureEvenement', null, [
                'widget' => 'single_text',
            ])
            ->add('descriptif')
            ->add('villeEvenement')
            ->add('codePostalEvenement')
            ->add('nomLieu')
            ->add('capaciteTotal')
            ->add('duree')
            ->add('tarifEvenement')
            ->add('statusEvenement')
            ->add('dateCreation', null, [
                'widget' => 'single_text',
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'id',
            ])
            ->add('User', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
