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
use Vyper\SiteBundle\Entity\Ad;
use Vyper\SiteBundle\Form\AdType;

class AdminAdController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAdAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $ad = new Ad;
        $form = $this->createForm(new AdType, $ad);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($ad);
                $em->flush();
            }

            $request->getSession()->getFlashBag()->add('info', 'Ad added.');
            return $this->redirect($this->generateUrl('admin_show_ads'));

        }

        $view
            ->set('form', $form->createView())
            ->set('user_role', $this->getUserRole())
            ->set('active_ad', true)
        ;

        return $this->render('VyperSiteBundle:AdminAd:addAd.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Ad $ad
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateAdAction(Request $request, Ad $ad)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new AdType, $ad);

        if ('POST' === $request->getMethod()) {

            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }
            $request->getSession()->getFlashBag()->add('info', 'Ad updated.');
        }

        $view
            ->set('ad', $ad)
            ->set('user_role', $this->getUserRole())
            ->set('active_ad', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminTour:updateTour.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAdsAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        // Get all the articles not deleted
        $ads  = $em->getRepository('VyperSiteBundle:Ad')->myFindAll();

        $view->set('ads',       $ads);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_ad", true);

        return $this->render('VyperSiteBundle:AdminAd:showAds.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Tour $tour
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Tour $tour)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('VyperSiteBundle:Event')->getByTourId($tour->getId());

        if (sizeof($events)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Tour is used in Event.');
        } else {

            $em->remove($tour);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Tour deleted.');
        }

        return $this->redirect($this->generateUrl('admin_show_tours'));
    }
} 