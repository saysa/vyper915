<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vyper\SiteBundle\Entity\Artist;

class ContestController extends Controller
{
    public function showAllAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());
        $view = $this->container->get('saysa_view');
        $contests_per_page = $this->container->getParameter('contests_per_page');

        $contests  = $em->getRepository('VyperSiteBundle:Contest')->showAll($contests_per_page, $page, $locale);

        $view
            ->set('contests', $contests)
            ->set('page', $page)
            ->set('total_contests', ceil(count($contests)/$contests_per_page))

        ;

        return $this->render('VyperSiteBundle:Contest:showAll.html.twig', $view->getView());

    }
}
