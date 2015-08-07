<?php

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LocationType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', 'entity', array(
                'class' => 'VyperSiteBundle:Country',
                'property' => 'name',
            ))
            ->add('name', 'text', array('attr' => array('placeholder' => 'Name')))
            ->add('nameReal', 'text', array('required' => false, 'attr' => array('placeholder' => 'Real Name')))
            ->add('town', 'text', array('attr' => array('placeholder' => 'Town')))
            ->add('townReal', 'text', array('required' => false, 'attr' => array('placeholder' => 'Real Town')))
            ->add('address', 'textarea', array('required' => false))
            ->add('access', 'textarea', array('required' => false))
            ->add('url', 'text', array('required' => false, 'attr' => array('placeholder' => 'URL')))
            ->add('googlemap', 'textarea', array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vyper\SiteBundle\Entity\Location'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_location';
    }
}
