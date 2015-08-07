<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vyper\SiteBundle\Entity\Manga;


class MangaController extends Controller
{

    public function showMangaAction(Manga $manga)
    {
        $view = $this->container->get('saysa_view');
        $view
            ->set('manga', $manga)
            ->set('current_mangaanime', true)
        ;

        return $this->render('VyperSiteBundle:Manga:showManga.html.twig', $view->getView());
    }

    public function showAllAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $magazines_per_page = $this->container->getParameter('mangas_per_page');

        $magazines = $em->getRepository('VyperSiteBundle:Manga')->showAll($magazines_per_page, $page);

        $view
            ->set('mangas', $magazines)
            ->set('page', $page)
            ->set('total_articles', ceil(count($magazines)/$magazines_per_page))
        ;

        return $this->render('VyperSiteBundle:Manga:showAll.html.twig', $view->getView());

    }

}
