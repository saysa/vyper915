<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 14:06
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminCommonController extends Controller {

    protected function _secure($request)
    {
        $session = $request->getSession();
        $user = $session->get('user');

        if (is_null($user)) return false;

        return true;
    }

    protected function _admin($request)
    {
        $session = $request->getSession();
        $userID = $session->get('user');

        $user_repository = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:User');
        $user = $user_repository->findOneBy(array(
            "id" => $userID,
            "admin" => true,
            "live" => true,
            "deleted" => false
        ));

        if (is_null($user)) return false;

        return true;
    }
} 