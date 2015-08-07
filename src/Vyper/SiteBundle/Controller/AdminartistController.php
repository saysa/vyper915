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
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function showArtistsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $type = $em->getRepository('VyperSiteBundle:ArtistType')->findByName("Musique");
        $artists  = $em->getRepository('VyperSiteBundle:Artist')->myFindAll($type);

        $view->set('artists', $artists);
        $view->set("active_artist", true);

        return $this->render('VyperSiteBundle:Adminartist:showArtists.html.twig', $view->getView());
    }

    public function addArtistAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $artist = new Artist();
        $form = $this->createForm(new ArtistType, $artist);

        if ($request->getMethod() == 'POST') {

            $post_data = $request->request->get('vyper_sitebundle_artist');

            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $artist->setPicture($picture);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($artist);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Artist added.');
                return $this->redirect($this->generateUrl('admin_show_artists'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('active_artist', true)
        ;

        return $this->render('VyperSiteBundle:Adminartist:addArtist.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Artist $artist
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateArtistAction(Request $request, Artist $artist)
    {
        $em = $this->getDoctrine()->getManager();

        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new ArtistType, $artist);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_artist');

            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $artist->setPicture($picture);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

        }

        $view
            ->set('artist', $artist)
            ->set('active_artist', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:Adminartist:updateArtist.html.twig', $view->getView());
    }
} 