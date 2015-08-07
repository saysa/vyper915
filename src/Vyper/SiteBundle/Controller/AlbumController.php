<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vyper\SiteBundle\Entity\Album;


class AlbumController extends Controller
{
    public function showAllAction($page, $category)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $albums_per_page = $this->container->getParameter('albums_per_page');

        $category = $em->getRepository('VyperSiteBundle:AlbumCategory')->findByName('concert');
        $albums  = $em->getRepository('VyperSiteBundle:Album')->showAll($albums_per_page, $page, $category);

        foreach ($albums as $album)
        {
            $album->cover = $em->getRepository('VyperSiteBundle:Picture')->getByAlbum($album);
        }

        $view
            ->set('current_album', true)
            ->set('albums', $albums)
            ->set('page', $page)
            ->set('total_albums', ceil(count($albums)/$albums_per_page))
        ;

        return $this->render('VyperSiteBundle:Album:showAll.html.twig', $view->getView());
    }

    public function recentPicturesAction()
    {

        $em = $this->getDoctrine()->getManager();
        $concert     = $em->getRepository('VyperSiteBundle:AlbumCategory')->findByName('concert');


        $view = $this->container->get('saysa_view');
        $pictures  = $em->getRepository('VyperSiteBundle:Picture')->showRandom($concert[0]);
        shuffle($pictures);
        $view->set('recent_pictures', $pictures);
        return $this->render('VyperSiteBundle:Album:recentPictures.html.twig', $view->getView());
    }

    public function showAlbumAction(Request $request, Album $album)
    {
        $em = $this->getDoctrine()->getManager();

        $increment = $this->container->get('vpr_visit_increment');
        $increment->increment($album, $em);

        $pictures  = $em->getRepository('VyperSiteBundle:Picture')->findBy(array('album' => $album->getId()));

        foreach ($pictures as $picture) {
            $picture->nbVotes  = $em->getRepository('VyperSiteBundle:Vote')->countVotes($picture);
            $picture->averageMark = $em->getRepository('VyperSiteBundle:Vote')->averageMark($picture);
            $picture->readonly = $em->getRepository('VyperSiteBundle:Vote')->ipAlreadyVoted($picture);
        }

        $view = $this->container->get('saysa_view');
        $view
            ->set('current_album', true)
            ->set('pictures', $pictures)
            ->set('album', $album)
            ->set("img_type_news", "true")
        ;

        return $this->render('VyperSiteBundle:Album:showAlbum.html.twig', $view->getView());
    }

}
