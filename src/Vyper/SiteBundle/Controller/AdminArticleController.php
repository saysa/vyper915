<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Article;
use Vyper\SiteBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminArticleController extends AdminCommonController {


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_REDAC')")
     */
    public function showArticlesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fluxRSS = $this->container->get('vpr_flux_rss');
        $opt = array(
            'entity_manager'    => $this->getDoctrine()->getManager(),
            'router'            => $this->get('router'),
            'app_root'          => $this->get('kernel')->getRootDir(),
            'assets'            => $this->container->get('templating.helper.assets'),
            'request'           => $request,
        );
        $fluxRSS->update($opt);

        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $articles     = $em->getRepository('VyperSiteBundle:Article')->myFindAll();
        $themes       = $em->getRepository('VyperSiteBundle:Theme')->myFindAll();
        $flashnews    = $em->getRepository('VyperSiteBundle:Flashnew')->myFindAll();

        $view->set('articles', $articles);
        $view->set("active_article", true);
        $view->set('themes', $themes);
        $view->set('flashnews', $flashnews);
        $view->set('user_role', $this->getUserRole());

        return $this->render('VyperSiteBundle:AdminArticle:showArticles.html.twig', $view->getView());
    }

    public function addArticleAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $article = new Article();
        $form = $this->createForm(new ArticleType, $article);

        if ($request->getMethod() == 'POST') {

            $post_data = $request->request->get('vyper_sitebundle_article');

            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);
            $article->setUser($this->getUser());
            $article->setPicture($picture);

            $dateArticle = new \DateTime($article->getReleaseDate()->format("Y-m-d") . " " . $article->getReleaseTime()->format("H:i:s"));
            $dateNow = new \DateTime("NOW");

            if ($dateArticle < $dateNow) {
                $article->setLive(true);
            } else if ($dateArticle > $dateNow) {
                $article->setLive(false);
            }

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Article added.');
                return $this->redirect($this->generateUrl('admin_show_articles'));

            }

        }

        $view->set('form', $form->createView());
        $view->set("active_article", true);

        return $this->render('VyperSiteBundle:AdminArticle:addArticle.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateArticleAction(Request $request, Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new ArticleType, $article);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_article');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $article->setPicture($picture);

            $dateArticle = new \DateTime($article->getReleaseDate()->format("Y-m-d") . " " . $article->getReleaseTime()->format("H:i:s"));
            $dateNow = new \DateTime("NOW");

            if ($dateArticle < $dateNow) {
                $article->setLive(true);
            } else if ($dateArticle > $dateNow) {
                $article->setLive(false);
            }

            if ($form->isValid()) {


                $em->flush();
            }

        }

        $type = $em->getRepository('VyperSiteBundle:ArtistType')->findByName("Musique");
        $artists  = $em->getRepository('VyperSiteBundle:Artist')->myFindAll($type);

        $view
            ->set('article', $article)
            ->set('artists', $artists)
            ->set('active_article', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminArticle:updateArticle.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteArticleAction(Request $request, Article $article)
    {
        // todo delete visit and search other relations in order to also delete them

        $em = $this->getDoctrine()->getManager();

        $visits = $em->getRepository('VyperSiteBundle:Visit')->getArticleVisitByArticleId($article->getId());

        foreach($visits as $visit) {
            $em->remove($visit);
        }

        $em->remove($article);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Article deleted.');
        return $this->redirect($this->generateUrl('admin_show_articles'));
    }
} 