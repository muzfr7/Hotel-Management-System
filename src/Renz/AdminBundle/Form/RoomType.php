<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoomType extends AbstractType
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
            ->add('price', 'text', array('label'=>'Standard', 'attr'=>array('class'=>'full title')))
            ->add('nonRefundablePrice', 'text', array('label'=>'Non-Refundable Price', 'attr'=>array('class'=>'full title')))
            ->add('capacity', 'text', array('label'=>'Capacity', 'attr'=>array('class'=>'full title')))
            ->add('shortDetail', 'textarea', array('label'=>'Short Detail', 'attr'=>array('class'=>'full title')))
            ->add('shortDetailar', 'textarea', array('label'=>'Short Detail Arabic', 'attr'=>array('class'=>'full title', 'style'=>'direction:rtl;')))
            ->add('longDetail', 'textarea', array('label'=>'Details', 'attr'=>array('class'=>'large full')))
            ->add('longDetailar', 'textarea', array('label'=>'Detail Arabic', 'attr'=>array('class'=>'large full', 'style'=>'direction:rtl;')))
            ->add('facility', 'textarea', array('label'=>'Facilities', 'attr'=>array('class'=>'small full')))
            ->add('facilityar', 'textarea', array('label'=>'Facilities Arabic', 'attr'=>array('class'=>'small full', 'style'=>'direction:rtl;')))
            ->add('file', 'file', array('label'=>'Photo', 'required'=>false, 'attr'=>array('class'=>'half title')))
            ->add('status', 'choice', array(
            	'label'=>'Room Visibility',
            	'choices' => array(
            		'1'=>'Published',
            		'0'=>'Disabled',
            	),
            	'multiple'=>false,
            	'attr'=>array('class'=>'full')
            ))
            ->add('guestfavourite', 'choice', array(
            		'label'=>'Guest Favourite',
            		'choices' => array(
            				'0'=>'No',
            				'1'=>'Yes',
            		),
            		'multiple'=>false,
            		'attr'=>array('class'=>'full')
            ))
            ->add('roomOrder', 'text', array('label'=>'Room Order', 'attr'=>array('class'=>'half title')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Room'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_room';
    }
}