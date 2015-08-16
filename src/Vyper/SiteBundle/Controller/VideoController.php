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
            ->set('videos', $videos)
            ->set('page', $page)
            ->set('total_videos', ceil(count($videos)/$videos_per_page))
        ;

        return $view->getView();
    }

}
