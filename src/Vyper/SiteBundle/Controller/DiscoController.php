<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Disco;


class DiscoController extends Controller
{

    public function showDiscoAction(Request $request, Disco $disco)
    {
        $em = $this->getDoctrine()->getManager();

        $increment = $this->container->get('vpr_visit_increment');
        $increment->increment($disco, $em);

        $titles  = $em->getRepository('VyperSiteBundle:Title')->findBy(array('disco' => $disco->getId()));
        $artists  = $disco->getArtists();
        $artist = $artists[0];

        $view = $this->container->get('saysa_view');
        $view->set('disco', $disco);
        $view->set('artist', $artist);
        $view->set('titles', $titles);

        return $this->render('VyperSiteBundle:Disco:showDisco.html.twig', $view->getView());
    }

    public function popularDiscosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $results  = $em->getRepository('VyperSiteBundle:Visit')->showPopularDisco();
        $popular_discos = array();
        foreach($results as $result) {
            $popular_discos[] = $result['item']->getDisco();
        }


        $view->set('popular_discos', $popular_discos);
        return $this->render('VyperSiteBundle:Disco:popularDiscos.html.twig', $view->getView());
    }

}
