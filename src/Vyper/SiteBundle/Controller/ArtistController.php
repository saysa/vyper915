<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vyper\SiteBundle\Entity\Artist;

class ArtistController extends Controller
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param Artist $artist
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArtistAction(Request $request, Artist $artist)
    {
        $em = $this->getDoctrine()->getManager();

        $increment = $this->container->get('vpr_visit_increment');
        $increment->increment($artist, $em);

        $view = $this->container->get('saysa_view');

        $artist  = $em->getRepository('VyperSiteBundle:Artist')->find($artist->getId());
        $articles   = $em->getRepository('VyperSiteBundle:Article')->getByArtist($artist);
        $events     = $em->getRepository('VyperSiteBundle:Event')->getByArtist($artist);
        $discos     = $em->getRepository('VyperSiteBundle:Disco')->getByArtist($artist, 4);
        $albums     = $em->getRepository('VyperSiteBundle:Album')->getByArtist($artist);

        foreach ($albums as $album)
        {
            $album->cover = $em->getRepository('VyperSiteBundle:Picture')->getByAlbum($album);
        }

        if (sizeof($articles)>0)    $view->set('articles', $articles);
        if (sizeof($events)>0)      $view->set('events', $events);
        if (sizeof($discos)>0)      $view->set('discos', $discos);
        if (sizeof($albums)>0)      $view->set('albums', $albums);

        $view
            ->set('artist', $artist)

        ;

        return $this->render('VyperSiteBundle:Artist:showArtist.html.twig', $view->getView());
    }

    public function showAllAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $articles_per_page = $this->container->getParameter('artists_per_page');
        $type = $em->getRepository('VyperSiteBundle:ArtistType')->findByName("Musique");
        # var_dump($type); // array 0 => objet ArtistType
        $artists  = $em->getRepository('VyperSiteBundle:Artist')->myFindAll($type);
        #$artistTypes = $em->getRepository('VyperSiteBundle:ArtistType')->findAll();

        $view
            #->set('artistTypes', $artistTypes)
            ->set('current_artists', true)
            ->set('artists', $artists)
            ->set('page', $page)
            ->set('total_artists', ceil(count($artists)/$articles_per_page))
        ;

        if ($request->isXmlHttpRequest()) {

            $template = $this->renderView('VyperSiteBundle:Artist:ajaxShowAll.html.twig', $view->getView());
            return new Response($template);

        } else {
            return $this->render('VyperSiteBundle:Artist:showAll.html.twig', $view->getView());
        }

    }

    public function showDiscoAction(Artist $artist, $page)
    {
        #var_dump($page);
        #die();
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $discos     = $em->getRepository('VyperSiteBundle:Disco')->getByArtist($artist, $page);
        $view
            ->set('artist', $artist)
            ->set('discos', $discos)
            ->set('page', $page)
        ;
        return $this->render('VyperSiteBundle:Artist:showDisco.html.twig', $view->getView());
    }

    public function infinteScrollShowDiscoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $artist  = $em->getRepository('VyperSiteBundle:Artist')->find($request->request->get('artist'));
        $view = $this->container->get('saysa_view');
        $discos     = $em->getRepository('VyperSiteBundle:Disco')->getByArtist($artist, $request->request->get('page'), 12);
        $view
            ->set('discos', $discos)
        ;

        $template = $this->renderView('VyperSiteBundle:Artist:isShowDisco.html.twig', $view->getView());
        return new Response($template);
    }

    public function recentArticlesAction()
    {
        $view = $this->container->get('saysa_view');
        $articles  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Article')->showRecentArticles();
        $view->set('recent_articles', $articles);
        return $this->render('VyperSiteBundle:Article:recentArticles.html.twig', $view->getView());
    }

    public function popularArtistsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $results  = $em->getRepository('VyperSiteBundle:Visit')->showPopularArtist();
        $popular_artists = array();
        foreach($results as $result) {
            $popular_artists[] = $result['item']->getArtist();
        }

        $view->set('popular_artists', $popular_artists);
        return $this->render('VyperSiteBundle:Artist:popularArtists.html.twig', $view->getView());
    }

}
