<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConditType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label'=>'Title', 'attr'=>array('class'=>'full title')))
            ->add('detail', 'textarea', array('label'=>'Long Detail', 'attr'=>array('class'=>'large full')))
            ->add('status', 'choice', array(
            	'label'=>'Room Visibility',
            	'choices' => array(
            		'1'=>'Published',
            		'0'=>'Disabled',
            	),
            	'multiple'=>false,
            	'attr'=>array('class'=>'full')
            ))
            ->add('room')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Condit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_condit';
    }
}
