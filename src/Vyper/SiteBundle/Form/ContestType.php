<?php

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContestType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('contestWinType', 'entity', array(
                'class' => 'VyperSiteBundle:ContestWinType',
                'property' => 'name',
            ))
            ->add('pictureID', 'text', array('required' => false, 'attr' => array('placeholder' => 'Picture ID')))
            ->add('title', 'text', array('attr' => array('placeholder' => 'Title')))
            ->add('prizes', 'text', array('attr' => array('placeholder' => 'Prizes')))
            ->add('description', 'textarea')
            ->add('howMuchWinners', 'integer')
            ->add('date', 'date', array('widget' => 'single_text'))
            ->add('dateEnd', 'date', array('widget' => 'single_text'))
            ->add('time', 'time', array('widget' => 'single_text'))
            ->add('timeEnd', 'time', array('widget' => 'single_text'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vyper\SiteBundle\Entity\Contest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vyper_sitebundle_contest';
    }
}
