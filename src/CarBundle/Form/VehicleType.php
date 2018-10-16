<?php

namespace CarBundle\Form;

use CarBundle\Model\VehicleManufacturer;
use CarBundle\Model\VehicleModels;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VehicleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('year');
        $builder->add('odometer');

        $builder->add('vehicleManufacturer', 'entity', array(
            'required' => true,
            'class' => 'CarBundle\Model\VehicleManufacturer',
            'choice_label' => 'manufacturer',
            'placeholder' => 'Select a Manufacturer',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('m')
                    ->orderBy('m.manufacturer', 'ASC');
            }
        ));
        ;

        $formModifier = function (FormInterface $form, VehicleManufacturer $manufacturer = null) {
            $model = null === $manufacturer ? array() : $manufacturer->getVehicleModels();

            $form->add('vehicleModels', "entity", array(
                'required' => true,
                'class' => 'CarBundle\Model\VehicleModels',
                'choices' => $model,
                'choice_label' => 'model',
                'placeholder' => 'Select a Model',
                'choices_as_values' => true
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getVehicleManufacturer());
            }
        );

        $builder->get('vehicleManufacturer')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $manufacturer = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $manufacturer);
            }
        );
    }

    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarBundle\Model\Vehicle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'carbundle_vehicle';
    }
}
