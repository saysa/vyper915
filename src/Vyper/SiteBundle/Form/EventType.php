<?php

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location', 'entity', array(
                'class' => 'VyperSiteBundle:Location',
                'property' => 'name',
            ))
            ->add('type', 'entity', array(
                'class' => 'VyperSiteBundle:EventType',
                'property' => 'name',
            ))
            ->add('tour', 'entity', array(
                'required' => false,
                'class' => 'VyperSiteBundle:Tour',
                'property' => 'title',
            ))
            ->add('pictureID', 'text', array('required' => false, 'attr' => array('placeholder' => 'Picture ID')))
            ->add('title', 'text', array('attr' => array('placeholder' => 'Title')))
            ->add('realTitle', 'text', array('required' => false, 'attr' => array('placeholder' => 'Real Title')))
            ->add('description', 'textarea')
            ->add('descriptionReal', 'textarea', array('required' => false))
            ->add('date', 'date', array('widget' => 'single_text'))
            ->add('time', 'time', array('widget' => 'single_text'))
            ->add('timeEnd', 'time', array('widget' => 'single_text'))
            ->add('price', 'text', array('required' => false, 'attr' => array('placeholder' => 'Price and Currency')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vyper\SiteBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_event';
    }
}
