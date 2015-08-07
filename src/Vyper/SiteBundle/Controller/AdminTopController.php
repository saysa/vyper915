<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Vyper\SiteBundle\Entity\Top;
use Vyper\SiteBundle\Form\TopType;

class AdminTopController extends AdminCommonController {

    public function addVideoAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $tour = new Video;
        $form = $this->createForm(new VideoType, $tour);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($tour);
                $em->flush();
            }
        }

        $view
            ->set('form', $form->createView())
            ->set('active_video', true)
        ;

        return $this->render('VyperSiteBundle:AdminVideo:addVideo.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Top $top
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateTopAction(Request $request, Top $top)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new TopType, $top);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_top');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $top->setPicture($picture);

            if ($form->isValid()) {

                $em->flush();
            }

        }

        $view
            ->set('top', $top)
            ->set('active_top', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminTop:updateTop.html.twig', $view->getView());
    }

    public function showTopsAction()
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        $top_music  = $em->getRepository('VyperSiteBundle:Top')->topMusic();
        $top_ost    = $em->getRepository('VyperSiteBundle:Top')->topOst();
        $top_manga  = $em->getRepository('VyperSiteBundle:Top')->topManga();
        $mangas = $em->getRepository('VyperSiteBundle:Manga')->findAll();

        foreach ($top_manga as $top) {
            $top->manga = $em->getRepository('VyperSiteBundle:Manga')->find($top->getItemId());
        }


        $view->set('top_music',     $top_music);
        $view->set('top_ost',       $top_ost);
        $view->set('top_manga',     $top_manga);
        $view->set('mangas',        $mangas);
        $view->set("active_top",  true);

        return $this->render('VyperSiteBundle:AdminTop:showTops.html.twig', $view->getView());
    }
} 