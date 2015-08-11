<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Components\Wordwrap\Wordwrap;

class IndexController extends Controller
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $session = $request->getSession();
        $user = $session->get('user');

        // get old article < now AND live = 0 // put to 1
        $articlesNotLive = $em->getRepository('VyperSiteBundle:Article')->articlesNotLive();
        #var_dump($articlesNotLive);
        foreach($articlesNotLive as $article) {
            $dateArticle = new \DateTime($article->getReleaseDate()->format("Y-m-d") . " " . $article->getReleaseTime()->format("H:i:s"));
            $dateNow = new \DateTime("NOW");

            if ($dateArticle < $dateNow) {

                // "set live true and persist
                $article->setLive(true);
                $em->persist($article);
            }
        }
        $em->flush();

        $articles_carousel = $em->getRepository('VyperSiteBundle:Article')->carousel();

        foreach ($articles_carousel as $article) {
            $w = new Wordwrap();
            $article->excerpt = $w->cutElypse($article->getDescription(), 150);
        }

        $type = array(
            '',
            $em->getRepository('VyperSiteBundle:ArticleType')->findByName("musique : chronique"),
            $em->getRepository('VyperSiteBundle:ArticleType')->findByName("musique : live report"),
            $em->getRepository('VyperSiteBundle:ArticleType')->findByName("musique : news"),
            $em->getRepository('VyperSiteBundle:ArticleType')->findByName("news"),
        );
        $latest_actu  = $em->getRepository('VyperSiteBundle:Article')->showAll($articles_per_page=5, $page=1, $type);

        $type = $em->getRepository('VyperSiteBundle:ArticleType')->findBy(array('name' => 'musique : news'));
        $latest_news = $em->getRepository('VyperSiteBundle:Article')->latestNews($type);

        $last_videos = $em->getRepository('VyperSiteBundle:Video')->lastFive();

        $view
            ->set('latest_actu', $latest_actu)
            ->set('articles_carousel', $articles_carousel)
            ->set('latest_news', $latest_news)
            ->set('last_videos', $last_videos)
            ->set('front_page_index', true)
            ->set('user_id', $user)
        ;
        return $this->render('VyperSiteBundle:Index:index.html.twig', $view->getView());
    }

}
