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
        $locale = $em->getRepository('VyperSiteBundle:LocaleType')->findByName($request->getLocale());

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

        $articles_carousel = $em->getRepository('VyperSiteBundle:Article')->carousel($locale);

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
        $latest_actu  = $em->getRepository('VyperSiteBundle:Article')->showAll($articles_per_page=5, $page=1, $type, $locale);

        $type = $em->getRepository('VyperSiteBundle:ArticleType')->findByName("News");
        $latest_news = $em->getRepository('VyperSiteBundle:Article')->latestNews($type, $locale);

        $type = $em->getRepository('VyperSiteBundle:ArticleType')->findByName("Chronique");
        $latest_chroniques = $em->getRepository('VyperSiteBundle:Article')->latestNews($type, $locale);

        $type = $em->getRepository('VyperSiteBundle:ArticleType')->findByName("Interview");
        $latest_interviews = $em->getRepository('VyperSiteBundle:Article')->latestNews($type, $locale);

        $type = $em->getRepository('VyperSiteBundle:ArticleType')->findByName("Live report");
        $latest_livereports = $em->getRepository('VyperSiteBundle:Article')->latestNews($type, $locale);

        $last_videos = $em->getRepository('VyperSiteBundle:Video')->lastFive();

        $themesInMenu = $em->getRepository('VyperSiteBundle:Theme')->getShowInMenu();

        // get 2 top-squares
        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Top Square A');
        $squareA = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);
        $adType = $em->getRepository('VyperSiteBundle:AdType')->findByName('Top Square B');
        $squareB = $em->getRepository('VyperSiteBundle:Ad')->getSquare($locale, $adType);

        $big_news = array(
            $latest_chroniques,
            $latest_interviews,
            $latest_livereports,
        );

        $view
            ->set('latest_actu', $latest_actu)
            ->set('latest_chroniques', $latest_chroniques)
            ->set('latest_interviews', $latest_interviews)
            ->set('latest_livereports', $latest_livereports)
            ->set('big_news', $big_news[mt_rand(0,2)])
            ->set('articles_carousel', $articles_carousel)
            ->set('latest_news', $latest_news)
            ->set('last_videos', $last_videos)
            ->set('themes_in_menu', $themesInMenu)
            ->set('front_page_index', true)
            ->set('user_id', $user)
            ->set('squareA', $squareA)
            ->set('squareB', $squareB)
        ;
        return $this->render('VyperSiteBundle:Index:index.html.twig', $view->getView());
    }

}
