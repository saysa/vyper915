<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MiscController extends Controller
{
    public function socialNetworkAction()
    {
        $view = $this->container->get('saysa_view');
        /**
         * Facebook fans
         */
        $fb = @json_decode(file_get_contents('https://graph.facebook.com/japanfm'));
        if(is_object($fb))
        {
            $fb_fans = number_format($fb->likes);
            $view->set("fb_fans", $fb_fans);
        }
        return $this->render('VyperSiteBundle:Misc:socialNetwork.html.twig', $view->getView());
    }


}
