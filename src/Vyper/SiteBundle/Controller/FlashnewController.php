<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Flashnew;


class FlashnewController extends Controller
{

    public function tickerlistAction()
    {
        $em = $this->getDoctrine()->getManager();

        $flashnews  = $em->getRepository('VyperSiteBundle:Flashnew')->tickerList();

        $view = $this->container->get('saysa_view');
        $view->set('ticker_flashnews', $flashnews);

        return $this->render('VyperSiteBundle:Flashnew:tickerlist.html.twig', $view->getView());
    }

    public function showFlashnewAction(Flashnew $flashnew)
    {
        $view = $this->container->get('saysa_view');
        $view->set('flashnew', $flashnew);
        return $this->render('VyperSiteBundle:Flashnew:showFlashnew.html.twig', $view->getView());
    }

}
