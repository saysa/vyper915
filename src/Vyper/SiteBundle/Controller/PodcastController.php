<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PodcastController extends Controller
{
    public function showAllAction(Request $request)
    {
        $podcast_videos = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Podcast')->getVideo();
        $view = $this->container->get('saysa_view');



        $view
            ->set('current_radio', true)
            ->set('podcast_videos', $podcast_videos)
        ;

        if ($request->isXmlHttpRequest()) {

            $template = $this->renderView('VyperSiteBundle:Podcast:ajaxShowAll.html.twig', $view->getView());
            return new Response($template);

        } else {
            return $this->render('VyperSiteBundle:Podcast:showAll.html.twig', $view->getView());
        }

    }

    public function showAllAudioAction(Request $request)
    {
        $podcast_audios = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Podcast')->getAudio();
        $view = $this->container->get('saysa_view');

        $view
            ->set('current_radio', true)
            ->set('podcast_audios', $podcast_audios)
        ;

        if ($request->isXmlHttpRequest()) {

            $template = $this->renderView('VyperSiteBundle:Podcast:ajaxShowAll.html.twig', $view->getView());
            return new Response($template);

        } else {
            return $this->render('VyperSiteBundle:Podcast:showAllAudio.html.twig', $view->getView());
        }
    }
}
