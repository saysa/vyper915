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
     * @Security("has_role('ROLE_ADMIN')")
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
            ->set('user_role', $this->getUserRole())
        ;

        return $this->render('VyperSiteBundle:AdminPartner:update.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAllAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(1);
        $partner_media    = $em->getRepository('VyperSiteBundle:Partner')->partnerMedia($type);
        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(2);
        $partner_event  = $em->getRepository('VyperSiteBundle:Partner')->partnerEvent($type);
        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(3);
        $partner_other  = $em->getRepository('VyperSiteBundle:Partner')->partnerOther($type);



        $view->set('partner_media',       $partner_media);
        $view->set('partner_event',     $partner_event);
        $view->set('partner_other',     $partner_other);
        $view->set('user_role', $this->getUserRole());

        $view->set("active_editable",  true);

        return $this->render('VyperSiteBundle:AdminPartner:showAll.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $partner = new Partner;
        $form = $this->createForm(new PartnerType, $partner);

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $post_data = $request->request->get('vyper_sitebundle_partner');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $partner->setPicture($picture);

            if ($form->isValid()) {

                $em->persist($partner);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Partner added.');
                return $this->redirect($this->generateUrl('admin_show_partners'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('active_editable', true)
            ->set('user_role', $this->getUserRole())
        ;

        return $this->render('VyperSiteBundle:AdminPartner:add.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Partner $partner
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Partner $partner)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($partner);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Partner deleted.');
        return $this->redirect($this->generateUrl('admin_show_partners'));
    }
} 