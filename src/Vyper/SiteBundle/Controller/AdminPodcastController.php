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
use Vyper\SiteBundle\Entity\Podcast;
use Vyper\SiteBundle\Form\PodcastType;

class AdminPodcastController extends AdminCommonController {

    public function addPodcastAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $podcast = new Podcast();
        $form = $this->createForm(new PodcastType, $podcast);

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $post_data = $request->request->get('vyper_sitebundle_podcast');
            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);
            $podcast->setPicture($picture);

            $podcast->setType($_POST['type']);

            if ($form->isValid()) {
                $em->persist($podcast);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Podcast added.');
                return $this->redirect($this->generateUrl('admin_show_videos'));
            }
        }

        $view
            ->set('form', $form->createView())
            ->set('active_video', true)
        ;

        return $this->render('VyperSiteBundle:AdminPodcast:addPodcast.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Podcast $podcast
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updatePodcastAction(Request $request, Podcast $podcast)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new PodcastType, $podcast);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_podcast');
            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);
            $podcast->setPicture($picture);

            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

        }

        $view
            ->set('podcast', $podcast)
            ->set('active_video', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminPodcast:updatePodcast.html.twig', $view->getView());
    }


} 