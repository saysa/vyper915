<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vyper\SiteBundle\Entity\Title;
use Vyper\SiteBundle\Entity\Top;

class AdminAjaxController extends AdminCommonController {

    public function totoAction(Request $request)
    {
        $theme_repository = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Theme');
        $theme = $theme_repository->findOneBy(array(
            "id" => $_POST['theme_id']
        ));
        if ($_POST['checkboxValue'] == "true")
        {
            $theme->setshowInMenu(1);
        }
        else{
            $theme->setshowInMenu(0);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function articleArtistLinkAction(Request $request)
    {
        $artist_id = $request->request->get('artist_id');
        if (isset($artist_id) && $artist_id != '-1') {

            $em = $this->getDoctrine()->getManager();
            $article = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Article')->find($request->request->get('item_id'));
            $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

            $article->addArtist($artist);
            $em->flush();
            $array = array("artist" => array("id" => $artist->getId(), "name" => $artist->getName()));
            echo json_encode($array);
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function albumArtistLinkAction(Request $request)
    {
        $artist_id = $request->request->get('artist_id');
        if (isset($artist_id) && $artist_id != '-1') {

            $em = $this->getDoctrine()->getManager();
            $album = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Album')->find($request->request->get('item_id'));
            $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

            $album->addArtist($artist);
            $em->flush();
            $array = array("artist" => array("id" => $artist->getId(), "name" => $artist->getName()));
            echo json_encode($array);
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function eventArtistLinkAction(Request $request)
    {
        $artist_id = $request->request->get('artist_id');
        if (isset($artist_id) && $artist_id != '-1') {

            $em = $this->getDoctrine()->getManager();
            $event = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Event')->find($request->request->get('item_id'));
            $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

            $event->addArtist($artist);
            $em->flush();
            $array = array("artist" => array("id" => $artist->getId(), "name" => $artist->getName()));
            echo json_encode($array);
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function discoArtistLinkAction(Request $request)
    {
        $artist_id = $request->request->get('artist_id');
        if (isset($artist_id) && $artist_id != '-1') {

            $em = $this->getDoctrine()->getManager();
            $disco = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Disco')->find($request->request->get('item_id'));
            $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

            $disco->addArtist($artist);
            $em->flush();
            $array = array("artist" => array("id" => $artist->getId(), "name" => $artist->getName()));
            echo json_encode($array);
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function videoArtistLinkAction(Request $request)
    {
        $artist_id = $request->request->get('artist_id');
        if (isset($artist_id) && $artist_id != '-1') {

            $em = $this->getDoctrine()->getManager();
            $video = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Video')->find($request->request->get('item_id'));
            $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

            $video->addArtist($artist);
            $em->flush();
            $array = array("artist" => array("id" => $artist->getId(), "name" => $artist->getName()));
            echo json_encode($array);
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function magazineArtistLinkAction(Request $request)
    {
        $artist_id = $request->request->get('artist_id');
        if (isset($artist_id) && $artist_id != '-1') {

            $em = $this->getDoctrine()->getManager();
            $magazine = $em->getRepository('VyperSiteBundle:Magazine')->find($request->request->get('item_id'));
            $artist  = $em->getRepository('VyperSiteBundle:Artist')->find($artist_id);

            $magazine->addArtist($artist);
            $em->flush();
            $array = array("artist" => array("id" => $artist->getId(), "name" => $artist->getName()));
            echo json_encode($array);
        }
        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function articleArtistLinkDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $artist_id = $request->request->get('artist_id');
        $article = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Article')->find($request->request->get('item_id'));
        $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

        $article->removeArtist($artist);
        $em->flush();

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function albumArtistLinkDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $artist_id = $request->request->get('artist_id');
        $album = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Album')->find($request->request->get('item_id'));
        $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

        $album->removeArtist($artist);
        $em->flush();

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function eventArtistLinkDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $artist_id = $request->request->get('artist_id');
        $event = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Event')->find($request->request->get('item_id'));
        $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

        $event->removeArtist($artist);
        $em->flush();

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function discoArtistLinkDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $artist_id = $request->request->get('artist_id');
        $disco = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Disco')->find($request->request->get('item_id'));
        $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

        $disco->removeArtist($artist);
        $em->flush();

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function videoArtistLinkDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $artist_id = $request->request->get('artist_id');
        $video = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Video')->find($request->request->get('item_id'));
        $artist  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Artist')->find($artist_id);

        $video->removeArtist($artist);
        $em->flush();

        return new Response();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function magazineArtistLinkDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $artist_id = $request->request->get('artist_id');
        $magazine = $em->getRepository('VyperSiteBundle:Magazine')->find($request->request->get('item_id'));
        $artist  = $em->getRepository('VyperSiteBundle:Artist')->find($artist_id);

        $magazine->removeArtist($artist);
        $em->flush();

        return new Response();
    }


    public function addTitleDiscoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $disco = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Disco')->find($request->request->get('disco_id'));
        $title = new Title();
        $title->setDisco($disco);
        $title->setNumber($request->request->get('title_number'));
        $title->setTitle($request->request->get('title_title'));
        $title->setTitleReal($request->request->get('title_title_real'));

        $em->persist($title);
        $em->flush();

        $array = array("title" => array("id" => $title->getId(),"number" => $request->request->get('title_number'), "title" => $request->request->get('title_title'), "title_real" => $request->request->get('title_title_real')));
        echo json_encode($array);

        return new Response();
    }

    public function removeTitleDiscoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $title = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Title')->find($request->request->get('title_id'));
        $em->remove($title);
        $em->flush();
        return new Response();
    }

    public function switchArticleHighlightAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('VyperSiteBundle:Article')->find($request->request->get('article_id'));

        if ($request->request->get('checkboxValue') == "true") {
            $article->setHighlight(true);
        } else {
            $article->setHighlight(false);
        }

        $em->persist($article);
        $em->flush();

        return new Response();
    }

    public function setTopMangaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $top_to_delete = $em->getRepository('VyperSiteBundle:Top')->getManga(array(
            'position' => $request->request->get('position'),
        ));

        if (sizeof($top_to_delete) > 0) {
            // delete
            foreach ($top_to_delete as $delete_me) {
                $em->remove($delete_me);
            }

        }

        $top = new Top();
        $top
            ->setType('manga')
            ->setPosition($request->request->get('position'))
            ->setItemId($request->request->get('manga_id'))
        ;
        $em->persist($top);
        $em->flush();

        $manga = $em->getRepository('VyperSiteBundle:Manga')->find($request->request->get('manga_id'));

        echo json_encode(array('manga' => $manga->getTitle()));

        return new Response();
    }
} 