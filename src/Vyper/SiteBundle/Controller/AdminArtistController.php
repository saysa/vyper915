<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Artist;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Vyper\SiteBundle\Form\ArtistType;

class AdminArtistController extends AdminCommonController {


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showArtistsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $artists  = $em->getRepository('VyperSiteBundle:Artist')->findAll();

        $view->set('artists', $artists);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_artist", true);

        return $this->render('VyperSiteBundle:AdminArtist:showArtists.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addArtistAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $artist = new Artist();
        $form = $this->createForm(new ArtistType, $artist);

        if ($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $post_data = $request->request->get('vyper_sitebundle_artist');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $artist->setPicture($picture);

            if ($form->isValid()) {


                $em->persist($artist);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Artist added.');
                return $this->redirect($this->generateUrl('admin_show_artists'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('user_role', $this->getUserRole())
            ->set('active_artist', true)
        ;

        return $this->render('VyperSiteBundle:AdminArtist:addArtist.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Artist $artist
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateArtistAction(Request $request, Artist $artist)
    {
        $em = $this->getDoctrine()->getManager();

        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new ArtistType, $artist);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_artist');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $artist->setPicture($picture);

            if ($form->isValid()) {

                $em->flush();
            }

        }

        $view
            ->set('artist', $artist)
            ->set('user_role', $this->getUserRole())
            ->set('active_artist', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminArtist:updateArtist.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Artist $artist
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Artist $artist)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($artist);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Artist deleted.');

        return $this->redirect($this->generateUrl('admin_show_artists'));
    }
} 