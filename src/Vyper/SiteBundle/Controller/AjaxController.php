<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vyper\SiteBundle\Entity\Song;
use Vyper\SiteBundle\Entity\Vote;


class AjaxController extends Controller
{
    public function ajaxAction(Request $request)
    {
        $response=null;
        if ($request->isXmlHttpRequest()) {
            $string_route = $request->request->get('cid');
            if (preg_match('!/events$!', $string_route)) {
                return $this->forward('VyperSiteBundle:Event:showAll');
            } elseif (preg_match('!/podcasts$!', $string_route)) {
                return $this->forward('VyperSiteBundle:Podcast:showAll');
            } elseif (preg_match('!/artistes!', $string_route)) {
                return $this->forward('VyperSiteBundle:Artist:showAll', array('page' => 1));
            }

        } else {
            echo "normal";
        }

        return new Response($response);
    }

    public function getDeviceAction(Request $request)
    {
        $device    = $request->request->get('device');

        if ($device == 'android') {
            echo 'https://play.google.com/store/apps/details?id=com.conduit.app_4e50177a5739444585a029434352002a.app&hl=fr_FR';
        } else if ($device == 'ios') {
            echo 'https://itunes.apple.com/US/app/id902475027';
        } else {
            echo 'https://itunes.apple.com/US/app/id902475027';
        }

        return new Response();
    }

    public function voteSongAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $item_id    = $request->request->get('item_id');
        $mark       = $request->request->get('mark');
        $ip         = $_SERVER['REMOTE_ADDR'];

        $song = $em->getRepository('VyperSiteBundle:Song')->find($item_id);

        if ($em->getRepository('VyperSiteBundle:Vote')->ipAlreadyVotedSong($song) == false) {

            $vote = new Vote();
            $vote->setIp($ip);
            $vote->setMark($mark);
            $vote->setSong($song);
            $vote->setMoment(new \DateTime('now'));

            $em->persist($vote);
            $em->flush();
        }

        return new Response();
    }

    public function votePictureAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $item_id    = $request->request->get('item_id');
        $mark       = $request->request->get('mark');
        $ip         = $_SERVER['REMOTE_ADDR'];

        $picture = $em->getRepository('VyperSiteBundle:Picture')->find($item_id);



        if ($em->getRepository('VyperSiteBundle:Vote')->ipAlreadyVoted($picture) == false) {

            $vote = new Vote();
            $vote->setIp($ip);
            $vote->setMark($mark);
            $vote->setPicture($picture);

            $em->persist($vote);
            $em->flush();
        }

        return new Response();
    }

    private function fillSong($playlist)
    {
        $em = $this->getDoctrine()->getManager();
        #var_dump($playlist);

        foreach($playlist as $song) {

            if ($em->getRepository('VyperSiteBundle:Song')->songAlreadyRegistered($song['artist'], $song['title']) == false) {
                $oSong = new Song();
                $oSong->setArtist($song['artist']);
                $oSong->setTitle($song['title']);
                $oSong->setPicture($song['cover']);
                $em->persist($oSong);
            }
        }
        $em->flush();
    }

    private function getSongsVote($playlist)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($playlist as $k => $item) {
            $song = $em->getRepository('VyperSiteBundle:Song')->findByArtistTitle($item['artist'], $item['title']);
            $playlist[$k]['nbVotes'] = $em->getRepository('VyperSiteBundle:Vote')->countSongVotes($song);
            $playlist[$k]['averageMark'] = $em->getRepository('VyperSiteBundle:Vote')->averageSongMark($song);
            $playlist[$k]['readonly'] = $em->getRepository('VyperSiteBundle:Vote')->ipAlreadyVotedSong($song);
            ###$playlist[$k]['readonly'] = true;
            $playlist[$k]['songId'] = $song[0]->getId();

        }

        return $playlist;
    }

    public function getPlaylistAction()
    {
        $filename = "http://japanfm.fr/playlist/playlist.xml";
        $playlistXML = simplexml_load_file($filename);

        $playlist = array();
        foreach ($playlistXML->xpath('//song') as $line) {
            $cover = (string) $line->picture;
            $playlist[] = array(
                "title" => (string) $line->title,
                "artist" => (string) $line->artist,
                "cover" => str_replace(" ","%20",$cover),
            );
        }

        // Fill database with new songs
        $this->fillSong($playlist);

        // get the vote for each song
        $playlist = $this->getSongsVote($playlist);

        echo json_encode($playlist);

        return new Response();
    }
}
