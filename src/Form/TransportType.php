<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Transport;
use App\Entity\TypeTransport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price_per_person')
            ->add('description')
            ->add('info_contact')
            ->add('date_creation_transport', null, [
                'widget' => 'single_text'
            ])
            ->add('place_departure')
            ->add('number_of_place')
            ->add('payment_info')
            ->add('transport_status')
            ->add('type_transport', EntityType::class, [
                'class' => TypeTransport::class,
'choice_label' => 'id',
            ])
            ->add('event', EntityType::class, [
                'class' => Event::class,
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
