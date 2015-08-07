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
use Vyper\SiteBundle\Entity\Location;
use Vyper\SiteBundle\Form\LocationType;

class AdminLocationController extends AdminCommonController {

    public function addLocationAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $location = new Location;
        $form = $this->createForm(new LocationType, $location);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($location);
                $em->flush();
            }

            $request->getSession()->getFlashBag()->add('info', 'Location added.');
            return $this->redirect($this->generateUrl('admin_show_locations'));
        }

        $view
            ->set('form', $form->createView())
            ->set('active_location', true)
        ;

        return $this->render('VyperSiteBundle:Adminlocation:addLocation.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateLocationAction(Request $request, Location $location)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new LocationType, $location);

        if ('POST' === $request->getMethod()) {

            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

        }

        $view
            ->set('location', $location)
            ->set('active_location', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:Adminlocation:updateLocation.html.twig', $view->getView());
    }

    public function showLocationsAction(Request $request)
    {
        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $locations  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Location')->myFindAll();

        $view->set('locations',       $locations);
        $view->set("active_location", true);

        return $this->render('VyperSiteBundle:Adminlocation:showLocations.html.twig', $view->getView());
    }
} 