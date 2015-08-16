<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class MenuController extends Controller
{

    public function MenuAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());

        $articles_carousel = $em->getRepository('VyperSiteBundle:Article')->carousel($locale);
        $themesInMenu = $em->getRepository('VyperSiteBundle:Theme')->getShowInMenu();

        $view = $this->container->get('saysa_view');
        $view
            ->set('themes_in_menu', $themesInMenu)
            ->set('highlight_in_menu', $articles_carousel)
        ;

        return $this->render('VyperSiteBundle:Menu:Menu.html.twig', $view->getView());
    }
}
