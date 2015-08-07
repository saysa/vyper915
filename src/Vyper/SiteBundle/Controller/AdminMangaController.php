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
use Vyper\SiteBundle\Entity\Manga;
use Vyper\SiteBundle\Form\MangaType;

class AdminMangaController extends AdminCommonController {

    public function addMangaAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $manga = new Manga;
        $form = $this->createForm(new MangaType, $manga);

        if ($request->getMethod() == 'POST') {

            $post_data = $request->request->get('vyper_sitebundle_manga');

            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $manga->setPicture($picture);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($manga);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Article added.');
                return $this->redirect($this->generateUrl('admin_show_mangas'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('active_magazine', true)
        ;

        return $this->render('VyperSiteBundle:AdminManga:addManga.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Manga $manga
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateMangaAction(Request $request, Manga $manga)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new MangaType, $manga);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_manga');

            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $manga->setPicture($picture);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

        }

        $view
            ->set('manga', $manga)
            ->set('active_magazine', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminManga:updateManga.html.twig', $view->getView());
    }

    public function showMangasAction()
    {
        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $mangas  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Manga')->myFindAll();

        $view->set('mangas',       $mangas);
        $view->set("active_magazine", true);

        return $this->render('VyperSiteBundle:AdminManga:showMangas.html.twig', $view->getView());
    }
} 