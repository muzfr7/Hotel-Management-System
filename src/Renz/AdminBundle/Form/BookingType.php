<?php

namespace Renz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('room', 'entity', array('label'=>'ROOM', 'class'=>'ModelBundle:Room', 'property'=>'title', 'attr'=>array('class'=>'full title')))
        	->add('cardtype', 'entity', array('label'=>'Credit Card Type', 'class'=>'ModelBundle:Cardtype', 'property'=>'title', 'attr'=>array('class'=>'full title')))
        	->add('bookingstatus', 'entity', array('label'=>'Booking Status', 'class'=>'ModelBundle:Bookingstatus', 'property'=>'title', 'attr'=>array('class'=>'full')))
        	->add('country', 'entity', array('label'=>'Country', 'class'=>'ModelBundle:Country', 'property'=>'shortname', 'attr'=>array('class'=>'full title')))
        	->add('expiryMonth', 'entity', array('label'=>'Expiry Month', 'class'=>'ModelBundle:Cardmonth', 'property'=>'title', 'attr'=>array('class'=>'full title')))
        	->add('expiryYear', 'entity', array('label'=>'Expiry Year', 'class'=>'ModelBundle:Cardyear', 'property'=>'title', 'attr'=>array('class'=>'full title')))
        	
            ->add('guests', 'text', array('label'=>'Guests', 'attr'=>array('class'=>'full title')))
            ->add('dateCheckin', 'date', array('label'=>'Check-in', 'widget' => "single_text", 'format' => 'yyyy-MM-dd', 'attr'=>array('class'=>'full title')))
            ->add('dateCheckout', 'date', array('label'=>'Check-out', 'widget' => "single_text", 'format' => 'yyyy-MM-dd', 'attr'=>array('class'=>'full title')))
            ->add('totalDays', 'text', array('label'=>'Total Nights', 'attr'=>array('class'=>'full title')))
            ->add('specialRequests', 'textarea', array('label'=>'Special Requests', 'required'=>false, 'attr'=>array('class'=>'full title')))
            ->add('firstname', 'text', array('label'=>'First Name', 'attr'=>array('class'=>'full title')))
            ->add('lastname', 'text', array('label'=>'Last Name', 'attr'=>array('class'=>'full title')))
            ->add('email', 'text', array('label'=>'Email', 'attr'=>array('class'=>'full title')))
            ->add('address', 'text', array('label'=>'Address', 'required'=>false, 'attr'=>array('class'=>'full title')))
            ->add('city', 'text', array('label'=>'City', 'attr'=>array('class'=>'full title')))
            ->add('zipcode', 'text', array('label'=>'Zip Code', 'required'=>false, 'attr'=>array('class'=>'full title')))
            ->add('mobile', 'text', array('label'=>'Mobile', 'attr'=>array('class'=>'full title')))
            ->add('cardownername', 'text', array('label'=>'Card Owner Name', 'attr'=>array('class'=>'full title')))
            ->add('cardnumber', 'text', array('label'=>'Credit Card Number', 'attr'=>array('class'=>'full title')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Renz\ModelBundle\Entity\Booking'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'renz_modelbundle_booking';
    }
}
