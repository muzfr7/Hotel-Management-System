<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label'=>'Title', 'attr'=>array('class'=>'full title')))
            ->add('titlear', 'text', array('label'=>'Title Arabic', 'attr'=>array('class'=>'full title')))
            ->add('details', 'textarea', array('label'=>'Short Detail', 'attr'=>array('class'=>'full title')))
            ->add('detailsar', 'textarea', array('label'=>'Short Detail Arabic', 'attr'=>array('class'=>'full title')))
            ->add('longDetails', 'textarea', array('label'=>'Long Detail', 'attr'=>array('class'=>'large full')))
            ->add('longDetailsar', 'textarea', array('label'=>'Long Detail Arabic', 'attr'=>array('class'=>'large full')))
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
            'data_class' => 'Renz\ModelBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_news';
    }
}
