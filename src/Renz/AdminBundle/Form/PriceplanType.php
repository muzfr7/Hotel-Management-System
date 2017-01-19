<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PriceplanType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateStart', 'date', array('label'=>'Start Date', 'format'=>'dd-MMMM-yyyy', 'attr'=>array('class'=>'title date')))
            ->add('dateEnd', 'date', array('label'=>'End Date', 'format'=>'dd-MMMM-yyyy', 'attr'=>array('class'=>'title date')))
            ->add('sunday', 'text', array('label'=>'Sunday', 'attr'=>array('class'=>'title', 'style'=>'width:80px; margin-right:5px;')))
            ->add('monday', 'text', array('label'=>'Monday', 'attr'=>array('class'=>'title', 'style'=>'width:80px; margin-right:5px;')))
            ->add('tuesday', 'text', array('label'=>'Tuesday', 'attr'=>array('class'=>'title', 'style'=>'width:80px; margin-right:5px;')))
            ->add('wednesday', 'text', array('label'=>'Wednesday', 'attr'=>array('class'=>'title', 'style'=>'width:80px; margin-right:5px;')))
            ->add('thursday', 'text', array('label'=>'Thursday', 'attr'=>array('class'=>'title', 'style'=>'width:80px; margin-right:5px;')))
            ->add('friday', 'text', array('label'=>'Friday', 'attr'=>array('class'=>'title', 'style'=>'width:80px; margin-right:5px;')))
            ->add('saturday', 'text', array('label'=>'Saturday', 'attr'=>array('class'=>'title', 'style'=>'width:80px;')))
            ->add('room')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Priceplan'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_priceplan';
    }
}
