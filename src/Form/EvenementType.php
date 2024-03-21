<?php

namespace App\Form;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\PostSubmitEvent;
use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EvenementType extends AbstractType
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
            ->add('nomEvenement', null, [
                'label' =>  "Nom de l'événement",
            ])
            ->add('dateEvenement', null, [
                'label' => 'Date de l\'événement',
                'widget' => 'single_text',
            ])
            ->add('heureEvenement', null, [
                'label' =>  'Heure de l\'événement',
                'widget' => 'single_text',
            ])
            ->add('descriptif', null, [
                'label' =>  'Description de l\'événement',
            ])
            ->add('villeEvenement', null, [
                'label' =>  'Ville de l\'événement',
            ])
            ->add('codePostalEvenement', null, [
                'label' => 'Code postal de l\'événement',
            ])
            ->add('adresse', null, [
                'label' => 'Adresse'
            ])
            ->add('nomLieu', null, [
                'label' => 'Nom du lieu',
            ])
            ->add('capaciteTotal', null, [
                'label' => 'Capacité totale (en nombre de personnes)'
            ])
            ->add('duree', null, [
                'label' => 'Durée en minutes'
            ])
            ->add('tarifEvenement', null, [
                'label' => 'Tarif de l\'entrée',
            ]);

            if ($role[0] === 'ROLE_ADMIN') {
                $builder->add('statusEvenement', ChoiceType::class, [
                    'choices'  => [
                        'En attente de validation' => 'En attente de validation',
                        'Validé' => 'Validé',
                        'Annulé' => 'Annulé',
                    ],
                ])
                    ->add('User', EntityType::class, [
                    'class' => User::class,
                    'choice_label' => 'id',
                    ]);
            }
            $builder->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'libelleCategorie',
                ])

            ->addEventListener(FormEvents::POST_SUBMIT, $this->attachTimestamps(...))
        ;
    }

    public function attachTimestamps(PostSubmitEvent $event): void
    {
        $data = $event->getData();
        if (!($data instanceof Evenement)) {
            return;
        }
        if (!$data->getId()){
            $data->setDateCreation(new \DateTimeImmutable());
        }    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
