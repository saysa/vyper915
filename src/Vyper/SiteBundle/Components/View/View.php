<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 09/08/14
 * Time: 16:13
 */

namespace Vyper\SiteBundle\Components\View;


class View {

    private $view = array();

    /**
     * @param $twig_var
     * @param $value
     * @return $this
     */
    public function set($twig_var, $value)
    {
        $this->view[$twig_var] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getView()
    {
        return $this->view;
    }
} 