<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vyper\SiteBundle\Entity\Top;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class TopController extends Controller
{

    public function topMangasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $top_manga  = $em->getRepository('VyperSiteBundle:Top')->topManga();
        foreach ($top_manga as $top) {
            $top->manga = $em->getRepository('VyperSiteBundle:Manga')->find($top->getItemId());
        }

        $view = $this->container->get('saysa_view');
        $view->set('top_mangas', $top_manga);

        return $this->render('VyperSiteBundle:Top:topMangas.html.twig', $view->getView());
    }

    public function topMusicsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $top_music  = $em->getRepository('VyperSiteBundle:Top')->topMusic();


        $view = $this->container->get('saysa_view');
        $view->set('top_musics', $top_music);

        return $this->render('VyperSiteBundle:Top:topMusics.html.twig', $view->getView());
    }

    /**
     * @Template
     */
    public function pageMusicAction()
    {
        $em = $this->getDoctrine()->getManager();

        $top_music  = $em->getRepository('VyperSiteBundle:Top')->topMusic();


        $view = $this->container->get('saysa_view')->set('top_musics', $top_music);

        return $view->getView();
    }

    public function topOstsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $top_music  = $em->getRepository('VyperSiteBundle:Top')->topOst();


        $view = $this->container->get('saysa_view');
        $view->set('top_osts', $top_music);

        return $this->render('VyperSiteBundle:Top:topOsts.html.twig', $view->getView());
    }


}
