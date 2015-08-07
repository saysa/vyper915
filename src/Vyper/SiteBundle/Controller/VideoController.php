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

}
