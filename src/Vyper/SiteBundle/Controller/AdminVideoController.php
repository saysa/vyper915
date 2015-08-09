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
use Vyper\SiteBundle\Entity\Video;
use Vyper\SiteBundle\Form\VideoType;

class AdminVideoController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addVideoAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $video = new Video;
        $form = $this->createForm(new VideoType, $video);

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $post_data = $request->request->get('vyper_sitebundle_video');
            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);
            $video->setPicture($picture);

            if ($form->isValid()) {


                $em->persist($video);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Video added.');
                return $this->redirect($this->generateUrl('admin_show_videos'));
            }
        }

        $view
            ->set('form', $form->createView())
            ->set('user_role', $this->getUserRole())
            ->set('active_video', true)
        ;

        return $this->render('VyperSiteBundle:AdminVideo:addVideo.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Video $video
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateVideoAction(Request $request, Video $video)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new VideoType, $video);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_video');
            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);
            $video->setPicture($picture);

            $form->submit($request);

            if ($form->isValid()) {

                $em->flush();
            }

        }

        $type = $em->getRepository('VyperSiteBundle:ArtistType')->findByName("Musique");
        $artists  = $em->getRepository('VyperSiteBundle:Artist')->myFindAll($type);

        $view
            ->set('video', $video)
            ->set('artists', $artists)
            ->set('active_video', true)
            ->set('user_role', $this->getUserRole())
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminVideo:updateVideo.html.twig', $view->getView());
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showVideosAction()
    {
        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $videos  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Video')->myFindAll();

        $view->set('videos',       $videos);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_video", true);

        return $this->render('VyperSiteBundle:AdminVideo:showVideos.html.twig', $view->getView());
    }
} 