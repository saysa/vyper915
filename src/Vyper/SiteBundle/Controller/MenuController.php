<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class MenuController extends Controller
{

    public function MenuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $themesInMenu = $em->getRepository('VyperSiteBundle:Theme')->getShowInMenu();

        $view = $this->container->get('saysa_view');
        $view->set('themes_in_menu', $themesInMenu);

        return $this->render('VyperSiteBundle:Menu:Menu.html.twig', $view->getView());
    }
}
