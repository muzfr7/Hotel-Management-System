<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HomepagefacilityType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label'=>'Title', 'attr'=>array('class'=>'full title')))
            ->add('titlear', 'text', array('label'=>'Title Arabic', 'attr'=>array('class'=>'full title', 'style'=>'direction:rtl;')))
            ->add('shortDetail', 'textarea', array('label'=>'Short Detail', 'attr'=>array('class'=>'full title')))
            ->add('shortDetailar', 'textarea', array('label'=>'Short Detail Arabic', 'attr'=>array('class'=>'full title', 'style'=>'direction:rtl;')))
            ->add('status', 'choice', array(
            	'label'=>'Room Visibility',
            	'choices' => array(
            		'1'=>'Published',
            		'0'=>'Disabled',
            	),
            	'multiple'=>false,
            	'attr'=>array('class'=>'full')
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Homepagefacility'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_homepagefacility';
    }
}
