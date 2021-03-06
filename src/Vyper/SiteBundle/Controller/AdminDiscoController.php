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
use Vyper\SiteBundle\Entity\Disco;
use Vyper\SiteBundle\Form\DiscoType;

class AdminDiscoController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addDiscoAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $disco = new Disco;
        $form = $this->createForm(new DiscoType, $disco);

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $post_data = $request->request->get('vyper_sitebundle_disco');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $disco->setPicture($picture);

            if ($form->isValid()) {


                $em->persist($disco);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Disco added.');
                return $this->redirect($this->generateUrl('admin_show_discos'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('user_role', $this->getUserRole())
            ->set('active_disco', true)
        ;

        return $this->render('VyperSiteBundle:AdminDisco:addDisco.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Disco $disco
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateDiscoAction(Request $request, Disco $disco)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new DiscoType, $disco);
        $em = $this->getDoctrine()->getManager();

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_disco');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $disco->setPicture($picture);

            if ($form->isValid()) {
                $em->flush();
            }

        }

        $artists  = $em->getRepository('VyperSiteBundle:Artist')->myFindAll();
        $titles   = $em->getRepository('VyperSiteBundle:Title')->findBy(
            array('disco' => $disco)
        );


        $view
            ->set('disco', $disco)
            ->set('artists', $artists)
            ->set('titles', $titles)
            ->set('active_disco', true)
            ->set('user_role', $this->getUserRole())
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminDisco:updateDisco.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showDiscosAction(Request $request)
    {
        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $discos  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Disco')->myFindAll();

        $view->set('discos',       $discos);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_disco", true);

        return $this->render('VyperSiteBundle:AdminDisco:showDiscos.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Disco $disco
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Disco $disco)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($disco);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Disco deleted.');

        return $this->redirect($this->generateUrl('admin_show_discos'));
    }
} 