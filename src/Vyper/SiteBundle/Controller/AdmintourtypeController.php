<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Vyper\SiteBundle\Entity\TourType;
use Vyper\SiteBundle\Form\TourTypeType;

class AdminTourTypeController extends AdminCommonController {

    public function addTourTypeAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $tourType = new TourType;
        $form = $this->createForm(new TourTypeType, $tourType);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($tourType);
                $em->flush();
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('active_tour', true)
        ;

        return $this->render('VyperSiteBundle:Admintourtype:addTourType.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param TourType $tourType
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateTourTypeAction(Request $request, TourType $tourType)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new TourTypeType, $tourType);

        if ('POST' === $request->getMethod()) {

            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

        }

        $view
            ->set('tourType', $tourType)
            ->set('active_tour', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:Admintourtype:updateTourType.html.twig', $view->getView());
    }

    public function showToursAction(Request $request)
    {
        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $tours  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Tour')->myFindAll();
        $tourTypes = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:TourType')->myFindAll();

        $view->set('tours',       $tours);
        $view->set('tourTypes',       $tourTypes);
        $view->set("active_tour", true);

        return $this->render('VyperSiteBundle:Admintour:showTours.html.twig', $view->getView());
    }
} 