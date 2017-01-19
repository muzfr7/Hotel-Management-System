<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BulkavailableType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fromdate', 'date', array('label'=>'From Date'))
            ->add('todate', 'date', array('label'=>'To Date'))
            ->add('qty')
            ->add('room')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Bulkavailable'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_bulkavailable';
    }
}
