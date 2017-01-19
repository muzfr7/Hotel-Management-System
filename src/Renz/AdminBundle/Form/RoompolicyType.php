<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoompolicyType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label'=>'Title', 'attr'=>array('class'=>'full title')))
            ->add('titlear', 'text', array('label'=>'Title Arabic', 'attr'=>array('class'=>'full title','style'=>'direction:rtl;')))
            ->add('detail', 'textarea', array('label'=>'Detail', 'attr'=>array('class'=>'large full')))
            ->add('detailar', 'textarea', array('label'=>'Detail Arabic', 'attr'=>array('class'=>'large full','style'=>'direction:rtl;')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Roompolicy'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_roompolicy';
    }
}
