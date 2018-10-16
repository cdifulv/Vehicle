<?php

namespace CarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ServiceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('serviceDate');

        $builder->add('serviceMileage');

        $builder->add('serviceItem', "entity", array(
            'class' => 'CarBundle\Model\ServiceItem',
            'choice_label' => 'itemType',
        ));

    }

        /**
         * @param OptionsResolverInterface $resolver
         */
        public function setDefaultOptions(OptionsResolverInterface $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'CarBundle\Model\Service'
            ));
        }

        /**
         * @return string
         */
        public function getName()
        {
            return 'carbundle_service';
        }

}
