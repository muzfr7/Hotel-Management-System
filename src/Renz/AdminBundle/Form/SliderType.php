<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SliderType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label'=>'Title', 'required'=>false, 'attr'=>array('class'=>'full title')))
            ->add('titlear', 'text', array('label'=>'Title Arabic', 'required'=>false, 'attr'=>array('class'=>'full title')))
            ->add('shortDetail', 'textarea', array('label'=>'Short Detail', 'attr'=>array('class'=>'full title')))
            ->add('shortDetailar', 'textarea', array('label'=>'Short Detail Arabic', 'attr'=>array('class'=>'full title', 'style'=>'direction:rtl;')))
            ->add('file', 'file', array('label'=>'Photo', 'required'=>false, 'attr'=>array('class'=>'half title')))
            ->add('status', 'choice', array(
            	'label'=>'Slider Visibility',
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
            'data_class' => 'Renz\ModelBundle\Entity\Slider'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_slider';
    }
}
