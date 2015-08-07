<?php

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TourType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'entity', array(
                'class' => 'VyperSiteBundle:TourType',
                'property' => 'name',
            ))
            ->add('continent', 'entity', array(
                'class' => 'VyperSiteBundle:Continent',
                'property' => 'name',
            ))
            ->add('title', 'text', array('attr' => array('placeholder' => 'Title')))
            ->add('realTitle', 'text', array('required' => false, 'attr' => array('placeholder' => 'Real Title')))
            ->add('description', 'textarea')
            ->add('descriptionLocal', 'textarea', array('required' => false))
            ->add('start', 'datetime', array('widget' => 'single_text'))
            ->add('end', 'datetime', array('widget' => 'single_text'))
            ->add('artistsKeywords', 'text', array('attr' => array('placeholder' => 'Keywords')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vyper\SiteBundle\Entity\Tour'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_tour';
    }
}
