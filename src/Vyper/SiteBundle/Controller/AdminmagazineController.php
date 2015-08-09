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
use Vyper\SiteBundle\Entity\Magazine;
use Vyper\SiteBundle\Form\MagazineType;

class AdminMagazineController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addMagazineAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $magazine = new Magazine;
        $form = $this->createForm(new MagazineType, $magazine);

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $post_data = $request->request->get('vyper_sitebundle_magazine');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $magazine->setPicture($picture);

            if ($form->isValid()) {

                $em->persist($magazine);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Magazine added.');
                return $this->redirect($this->generateUrl('admin_show_magazines'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('user_role', $this->getUserRole())
            ->set('active_magazine', true)
        ;

        return $this->render('VyperSiteBundle:Adminmagazine:addMagazine.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Magazine $magazine
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateMagazineAction(Request $request, Magazine $magazine)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new MagazineType, $magazine);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_magazine');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $magazine->setPicture($picture);

            if ($form->isValid()) {

                $em->flush();
            }

        }

        $type = $em->getRepository('VyperSiteBundle:ArtistType')->findByName("Musique");
        $artists  = $em->getRepository('VyperSiteBundle:Artist')->myFindAll($type);

        $view
            ->set('magazine', $magazine)
            ->set('artists', $artists)
            ->set('user_role', $this->getUserRole())
            ->set('active_magazine', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:Adminmagazine:updateMagazine.html.twig', $view->getView());
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showMagazinesAction()
    {
        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $magazines  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Magazine')->myFindAll();

        $view->set('magazines',       $magazines);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_magazine", true);

        return $this->render('VyperSiteBundle:Adminmagazine:showMagazines.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Magazine $magazine
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Magazine $magazine)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($magazine);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Magazine deleted.');

        return $this->redirect($this->generateUrl('admin_show_magazines'));
    }
} 