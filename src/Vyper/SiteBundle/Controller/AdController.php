<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class AdController extends Controller
{

    public function Header468Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());
        
        $view = $this->container->get('saysa_view');

        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Header (desktop)');
        $header = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);
        
        $view
            ->set('ad_header', $header)
        ;

        return $this->render('VyperSiteBundle:Ad:Header468.html.twig', $view->getView());
    }
}
