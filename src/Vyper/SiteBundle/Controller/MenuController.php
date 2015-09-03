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

        $type = $em->getRepository('VyperSiteBundle:ArticleType')->findByName("Magazine");
        $highlight_without_magazine = $em->getRepository('VyperSiteBundle:Article')->highlightWithoutMagazine($locale, $type);

        $themesInMenu = $em->getRepository('VyperSiteBundle:Theme')->getShowInMenu();

        $view = $this->container->get('saysa_view');
        $view
            ->set('themes_in_menu', $themesInMenu)
            ->set('highlight_in_menu', $articles_carousel)
            ->set('highlight_without_magazine', $highlight_without_magazine)
        ;

        return $this->render('VyperSiteBundle:Menu:Menu.html.twig', $view->getView());
    }
}
