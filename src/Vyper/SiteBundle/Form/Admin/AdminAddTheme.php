<?php
/**
 * Created by PhpStorm.
 * User: saysa
 * Date: 22/08/2014
 * Time: 17:10
 */

namespace Vyper\SiteBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminAddTheme extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
        ;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'AdminAddTheme';
    }
}