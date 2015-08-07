<?php

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ContactForm extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', 'text', array('attr' => array('placeholder' => 'Votre nom et prénom')))
            ->add('societe', 'text', array('required' => false, 'attr' => array('placeholder' => 'Société')))
            ->add('sujet', 'text', array('attr' => array('placeholder' => 'Détail')))
            ->add('email', 'email', array('attr' => array('placeholder' => 'Adresse e-mail')))
            ->add('message', 'textarea', array('attr' => array('rows' => '5')))
        ;

        //setting the captcha
        $settings=array(
            'width'=>206,
            'height'=>57,
            'font_size'=>22,
            'length'=>7,
            'border_color'=>"cccccc"
        );

        //add captcha to builder
        $builder->add('securitycod', 'genemu_captcha', $settings);
        $builder->add('body', 'textarea');
    }
    


    /**
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }
}
