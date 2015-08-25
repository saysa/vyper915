<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Album;
use Vyper\SiteBundle\Entity\Artist;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Vyper\SiteBundle\Form\AlbumType;
use Vyper\SiteBundle\Form\ArtistType;

class AdminAlbumController extends AdminCommonController {

    public function addAlbumAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $album = new Album;
        $form = $this->createForm(new AlbumType, $album);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($album);
                $em->flush();
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('active_picture', true)
        ;

        return $this->render('VyperSiteBundle:AdminAlbum:addAlbum.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Album $album
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateAlbumAction(Request $request, Album $album)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new AlbumType, $album);

        if ('POST' === $request->getMethod()) {

            $form->submit($request);

            if ($form->isValid()) {

                $em->flush();
            }

        }

        $artists  = $em->getRepository('VyperSiteBundle:Artist')->myFindAll();

        $view
            ->set('album', $album)
            ->set('artists', $artists)
            ->set('active_picture', true)
            ->set('user_role', $this->getUserRole())
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminAlbum:updateAlbum.html.twig', $view->getView());
    }
} 