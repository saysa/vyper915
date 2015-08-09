<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Picture;
use Vyper\SiteBundle\Form\PictureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminPictureController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showPicturesAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        // Get all the articles not deleted
        $pictures  = $em->getRepository('VyperSiteBundle:Picture')->myFindAll();
        $albums    = $em->getRepository('VyperSiteBundle:Album')  ->myFindAll();

        $view->set('albums',         $albums);
        $view->set('pictures',       $pictures);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_picture", true);

        return $this->render('VyperSiteBundle:AdminPicture:showPictures.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addPictureAction(Request $request)
    {

        $view = $this->container->get('saysa_view');
        $picture = new Picture();
        $form = $this->createForm(new PictureType(), $picture);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($picture);
                $em->flush();
            }
            $request->getSession()->getFlashBag()->add('info', 'Picture added.');
            return $this->redirect($this->generateUrl('admin_show_pictures'));
        }

        $view->set('form', $form->createView());
        $view->set('user_role', $this->getUserRole());
        $view->set("active_picture", true);

        return $this->render('VyperSiteBundle:AdminPicture:addPicture.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Picture $picture)
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('VyperSiteBundle:Article')->getByPictureId($picture->getId());
        $artists = $em->getRepository('VyperSiteBundle:Artist')->getByPictureId($picture->getId());
        $tops = $em->getRepository('VyperSiteBundle:Top')->getPictureTopByPictureId($picture->getId());
        $partners = $em->getRepository('VyperSiteBundle:Partner')->getByPictureId($picture->getId());
        $magazines = $em->getRepository('VyperSiteBundle:Magazine')->getByPictureId($picture->getId());
        $videos = $em->getRepository('VyperSiteBundle:Video')->getByPictureId($picture->getId());
        $programType = $em->getRepository('VyperSiteBundle:ProgramType')->getByPictureId($picture->getId());
        $podcasts = $em->getRepository('VyperSiteBundle:Podcast')->getByPictureId($picture->getId());
        $events = $em->getRepository('VyperSiteBundle:Event')->getByPictureId($picture->getId());
        $discos = $em->getRepository('VyperSiteBundle:Disco')->getByPictureId($picture->getId());



        if (sizeof($tops)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Top.');
        } else if (sizeof($articles)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Article.');
        } else if (sizeof($artists)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Artist.');
        } else if (sizeof($partners)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Partner.');
        } else if (sizeof($magazines)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Magazine.');
        } else if (sizeof($videos)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Video.');
        } else if (sizeof($programType)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Program Type.');
        } else if (sizeof($podcasts)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Podcast.');
        } else if (sizeof($events)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Event.');
        } else if (sizeof($discos)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The Picture is used in Disco.');
        } else {
            $em->remove($picture);
            $em->flush();

            if(is_file(__DIR__ . "/../../../../web/" . $picture->getPath())) {
                unlink(__DIR__ . "/../../../../web/" . $picture->getPath());
            }

            $request->getSession()->getFlashBag()->add('info', 'Picture deleted.');
        }

        return $this->redirect($this->generateUrl('admin_show_pictures'));
    }
} 