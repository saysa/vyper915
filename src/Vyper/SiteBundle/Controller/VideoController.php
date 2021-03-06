<?php

namespace Vyper\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vyper\SiteBundle\Entity\Video;


class VideoController extends Controller
{

    /**
     * @param Video $video
     * @return array
     * @Template()
     */
    public function showVideoAction(Video $video)
    {
        $view = $this->container->get('saysa_view');
        $view->set('video', $video);
        return $view->getView();
    }

    /**
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     * @Template()
     */
    public function showAllAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $videos_per_page = $this->container->getParameter('videos_per_page');

        $videos = $em->getRepository('VyperSiteBundle:Video')->showAll($videos_per_page, $page);

        $view
            ->set('current_videos', true)
            ->set('videos', $videos)
            ->set('page', $page)
            ->set('total_videos', ceil(count($videos)/$videos_per_page))
        ;

        return $view->getView();
    }

    public function latestVideoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $video = $em->getRepository('VyperSiteBundle:Video')->last();
        $view = $this->container->get('saysa_view');

        if (sizeof($video) > 0) {

            $view->set('lastVideo_video', $video[0]);
            $view->set('lastVideo_exists', true);

        }

        return $this->render('VyperSiteBundle:Video:lastVideo.html.twig', $view->getView());
    }

}
