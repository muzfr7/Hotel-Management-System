<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestimonialType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname', 'text', array('label'=>'Full Name', 'attr'=>array('class'=>'full title')))
            ->add('fullnamear', 'text', array('label'=>'Full Name Arabic', 'attr'=>array('class'=>'full title', 'style'=>'direction:rtl;')))
            ->add('comment', 'textarea', array('label'=>'Long Detail', 'attr'=>array('class'=>'large full')))
            ->add('commentar', 'textarea', array('label'=>'Long Detail Arabic', 'attr'=>array('class'=>'large full', 'style'=>'direction:rtl;')))
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
            'data_class' => 'Renz\ModelBundle\Entity\Testimonial'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_testimonial';
    }
}
