<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoomclosureType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('closefrom', 'date', array('label'=>'From', 'format'=>'dd-MMMM-yyyy', 'years' => range(Date('Y')+5, Date('Y')), 'attr'=>array('class'=>'title date')))
            ->add('closeto', 'date', array('label'=>'To', 'format'=>'dd-MMMM-yyyy', 'years' => range(Date('Y')+5, Date('Y')), 'attr'=>array('class'=>'title date')))
            ->add('room', 'entity', array('label'=>'ROOMS', 'class'=>'ModelBundle:Room', 'multiple' => true, 'expanded' => true, 'property'=>'title'))
            ->add('isAvailableStandard', 'checkbox', array('label'=>'Standard Price', 'required'=>false))
            ->add('isAvailableNonRefundable', 'checkbox', array('label'=>'Non-Refundable', 'required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Roomclosure'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_roomclosure';
    }
}
