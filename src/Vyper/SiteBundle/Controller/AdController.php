<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdController
 *
 * @package Vyper\SiteBundle\Controller
 */
class AdController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function Header728Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());

        $view = $this->container->get('saysa_view');

        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Header (728x90px)');
        $header = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);

        $view
            ->set('ad_header', $header)
        ;

        return $this->render('VyperSiteBundle:Ad:Header728.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function Header468Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());
        
        $view = $this->container->get('saysa_view');

        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Header (468x60px)');
        $header = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);
        
        $view
            ->set('ad_header', $header)
        ;

        return $this->render('VyperSiteBundle:Ad:Header468.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function Header320Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());

        $view = $this->container->get('saysa_view');

        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Header (320x100px)');
        $header = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);

        $view
            ->set('ad_header', $header)
        ;

        return $this->render('VyperSiteBundle:Ad:Header320.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function Skycraper1200Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());

        $view = $this->container->get('saysa_view');

        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Right column big (300px large)');
        $header = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);

        $view
            ->set('ad_header', $header)
        ;

        return $this->render('VyperSiteBundle:Ad:Skycraper1200.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function SkycraperMiddleAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());

        $view = $this->container->get('saysa_view');

        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Right column normal (160px large)');
        $header = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);

        $view
            ->set('ad_header', $header)
        ;

        return $this->render('VyperSiteBundle:Ad:SkycraperMiddle.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function SkycraperMobileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());

        $view = $this->container->get('saysa_view');

        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Right column small (250px large)');
        $header = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);

        $view
            ->set('ad_header', $header)
        ;

        return $this->render('VyperSiteBundle:Ad:SkycraperMobile.html.twig', $view->getView());
    }
}
