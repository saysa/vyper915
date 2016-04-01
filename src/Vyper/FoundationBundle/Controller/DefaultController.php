<?php

namespace Vyper\FoundationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VyperFoundationBundle:Default:index.html.twig', array('name' => $name));
    }
}
