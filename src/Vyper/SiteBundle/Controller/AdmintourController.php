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
use Vyper\SiteBundle\Entity\Tour;
use Vyper\SiteBundle\Form\TourType;

class AdminTourController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addTourAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $tour = new Tour;
        $form = $this->createForm(new TourType, $tour);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($tour);
                $em->flush();
            }

            $request->getSession()->getFlashBag()->add('info', 'Tour added.');
            return $this->redirect($this->generateUrl('admin_show_tours'));

        }

        $view
            ->set('form', $form->createView())
            ->set('active_tour', true)
        ;

        return $this->render('VyperSiteBundle:AdminTour:addTour.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Tour $tour
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateTourAction(Request $request, Tour $tour)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new TourType, $tour);

        if ('POST' === $request->getMethod()) {

            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }
            $request->getSession()->getFlashBag()->add('info', 'Tour updated.');
        }

        $view
            ->set('tour', $tour)
            ->set('active_tour', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:Admintour:updateTour.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showToursAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        // Get all the articles not deleted
        $tours  = $em->getRepository('VyperSiteBundle:Tour')->myFindAll();
        $tourTypes = $em->getRepository('VyperSiteBundle:TourType')->myFindAll();

        $view->set('tours',       $tours);
        $view->set('tourTypes',       $tourTypes);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_tour", true);

        return $this->render('VyperSiteBundle:Admintour:showTours.html.twig', $view->getView());
    }
} 