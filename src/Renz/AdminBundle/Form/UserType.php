<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('label'=>'Username', 'attr'=>array('class'=>'half title')))
            ->add('password', 'password', array('label'=>'Password', 'attr'=>array('class'=>'half title')))
            ->add('email', 'email', array('label'=>'Email', 'attr'=>array('class'=>'half title')))
            ->add('isActive', 'choice', array(
            		'label'=>'User Status',
            		'choices' => array(
            				'1'=>'Active',
            				'0'=>'Disabled',
            		),
            		'multiple'=>false,
            		'attr'=>array('class'=>'full')
            ))
            ->add('roles', 'entity', array('label'=>'Role', 'class'=>'ModelBundle:Role', 'property'=>'name', 'multiple'=>true, 'required'=>true, 'attr'=>array('class'=>'full title')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_user';
    }
}
