<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Transport;
use App\Entity\TypeTransport;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('TarifPersonne')
            ->add('descriptif')
            ->add('InfoContact')
            ->add('DateDepart', null, [
                'widget' => 'single_text',
            ])
            ->add('DateCreation', null, [
                'widget' => 'single_text',
            ])
            ->add('LieuDepart')
            ->add('NbPlace')
            ->add('InfoPaiement')
            ->add('StatutTransport')
            ->add('TypeTransport', EntityType::class, [
                'class' => TypeTransport::class,
                'choice_label' => 'libelle_transport',
            ])
            ->add('evenement', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => 'nom_evenement',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
