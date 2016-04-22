<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class AdController extends Controller
{

    public function HeaderAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());
        
        $view = $this->container->get('saysa_view');
        

        return $this->render('VyperSiteBundle:Ad:Header.html.twig', $view->getView());
    }
}
