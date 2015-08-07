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
use Vyper\SiteBundle\Entity\Partner;
use Vyper\SiteBundle\Entity\Top;
use Vyper\SiteBundle\Form\PartnerType;
use Vyper\SiteBundle\Form\TopType;

class AdminPartnerController extends AdminCommonController {



    /**
     * @param Request $request
     * @param Partner $partner
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateAction(Request $request, Partner $partner)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new PartnerType, $partner);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_partner');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $partner->setPicture($picture);

            if ($form->isValid()) {

                $em->flush();
            }

        }

        $view
            ->set('partner', $partner)
            ->set('active_editable', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminPartner:update.html.twig', $view->getView());
    }

    public function showAllAction()
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(1);
        $partner_media    = $em->getRepository('VyperSiteBundle:Partner')->partnerMedia($type);
        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(2);
        $partner_event  = $em->getRepository('VyperSiteBundle:Partner')->partnerEvent($type);



        $view->set('partner_media',       $partner_media);
        $view->set('partner_event',     $partner_event);

        $view->set("active_editable",  true);

        return $this->render('VyperSiteBundle:AdminPartner:showAll.html.twig', $view->getView());
    }

    public function addAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $partner = new Partner;
        $form = $this->createForm(new PartnerType, $partner);

        if ($request->getMethod() == 'POST') {

            $post_data = $request->request->get('vyper_sitebundle_partner');

            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $partner->setPicture($picture);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($partner);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Partner added.');
                return $this->redirect($this->generateUrl('admin_show_partners'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('active_editable', true)
        ;

        return $this->render('VyperSiteBundle:AdminPartner:add.html.twig', $view->getView());
    }

    public function deleteAction(Request $request, Partner $partner)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($partner);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Partner deleted.');
        return $this->redirect($this->generateUrl('admin_show_partners'));
    }
} 