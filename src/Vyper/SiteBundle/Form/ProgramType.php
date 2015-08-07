<?php

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgramType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'entity', array(
                'class' => 'VyperSiteBundle:ProgramType',
                'property' => 'title',
            ))
            ->add('title', 'text', array('attr' => array('placeholder' => 'Title')))
            ->add('description', 'textarea', array('required' => false))
            ->add('date', 'date', array('widget' => 'single_text'))
            ->add('startTime', 'time', array('widget' => 'single_text'))
            ->add('endTime', 'time', array('widget' => 'single_text'))
            ->add('lang', 'text', array('required' => false, 'attr' => array('placeholder' => 'Lang')))
            ->add('present', 'text', array('required' => false, 'attr' => array('placeholder' => 'Cadeaux')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vyper\SiteBundle\Entity\Program'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_program';
    }
}
