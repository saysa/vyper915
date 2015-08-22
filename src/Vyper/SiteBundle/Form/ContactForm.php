<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 10/03/15
 * Time: 22:08
 */

namespace Vyper\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text', array('attr' => array('placeholder' => 'Prénom *')))
            ->add('lastname', 'text', array('attr' => array('placeholder' => 'Nom *')))
            ->add('email', 'email', array('attr' => array('placeholder' => 'E-Mail *')))
            ->add('website', 'text', array('required' => false, 'attr' => array('placeholder' => 'Site Internet')))
            ->add('message', 'textarea', array('attr' => array('placeholder' => 'Message', 'rows' => '10')))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }
} 