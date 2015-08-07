<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 31/07/14
 * Time: 22:07
 */

namespace Vyper\SiteBundle\Form\Login;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Login extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text')
            ->add('password', 'password')
        ;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'Login';
    }
}