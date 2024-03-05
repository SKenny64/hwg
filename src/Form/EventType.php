<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\ImageEvent;
use App\Entity\Transport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_event')
            ->add('date_event', null, [
                'widget' => 'single_text'
            ])
            ->add('hour_event', null, [
                'widget' => 'single_text'
            ])
            ->add('description')
            ->add('date_event_creation', null, [
                'widget' => 'single_text'
            ])
            ->add('city_event')
            ->add('adress_event')
            ->add('zip_event')
            ->add('name_place')
            ->add('total_capacity')
            ->add('duration')
            ->add('price_event')
            ->add('event_status')
            ->add('transport', EntityType::class, [
                'class' => Transport::class,
'choice_label' => 'id',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])
            ->add('imageEvent', EntityType::class, [
                'class' => ImageEvent::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
