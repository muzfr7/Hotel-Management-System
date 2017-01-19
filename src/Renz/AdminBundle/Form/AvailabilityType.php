<?php

namespace Renz\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AvailabilityType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', 'date', array('label'=>'Date', 'allow_add'=>true, 'attr'=>array('class'=>'half title')))
            ->add('qty', 'text', array('label'=>'Quantity', 'allow_add'=>true, 'attr'=>array('class'=>'half title')))
            ->add('isAvailable', 'date', array('label'=>'Date', 'allow_add'=>true, 'attr'=>array('class'=>'half title')))
            ->add('isRefundable', 'date', array('label'=>'Date', 'allow_add'=>true, 'attr'=>array('class'=>'half title')))
            ->add('room')
            ->add('rate')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Availability'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_availability';
    }
}
