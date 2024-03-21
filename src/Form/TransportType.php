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
use Symfony\Bundle\SecurityBundle\Security;

class TransportType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $role = $this->security->getUser()->getRoles();
        
        $builder
            ->add('TarifPersonne', null, [
                'label' => "Tarif par personne",
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('descriptif', null, [
                'label' => "Description du transport : ",
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('InfoContact', null, [
                'label' =>  "Informations de contact (facultatif)",
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('DateDepart', null, [
                'label' =>  'Date et heure de départ',
                'widget' => 'single_text',
            ])
            ->add('DateCreation', null, [
                'widget' => 'single_text',
            ])
            ->add('LieuDepart', null, [
                'label' =>  'Ville de départ',
                'attr' => [
                'label' => "Lieu de départ",
                'class' => 'form-control',
                ]
            ])
            ->add('NbPlace', null, [
                'label' =>  'Nombre de places disponibles',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('InfoPaiement', null, [
                'label' => 'Information sur le paiement',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('StatutTransport')
            ->add('TypeTransport', EntityType::class, [
                'label' => 'Type de transport',
                'class' => TypeTransport::class,
                'choice_label' => 'libelle_transport',
            ]);

            if ($role == ['ROLE_ADMIN']) {
            $builder->add('evenement', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => 'nom_evenement',
                'disabled' => true,
                ])
                ->add('user', EntityType::class, [
                    'class' => User::class,
                    'choice_label' => 'id',
                    'mapped' => False,
                ]);
            }
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
