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
use Vyper\SiteBundle\Entity\Event;
use Vyper\SiteBundle\Form\EventType;

class AdminEventController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addEventAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $event = new Event;
        $form = $this->createForm(new EventType, $event);

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $post_data = $request->request->get('vyper_sitebundle_event');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $event->setPicture($picture);

            if ($form->isValid()) {

                $em->persist($event);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Event added.');
                return $this->redirect($this->generateUrl('admin_show_events'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('user_role', $this->getUserRole())
            ->set('active_event', true)
        ;

        return $this->render('VyperSiteBundle:Adminevent:addEvent.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateEventAction(Request $request, Event $event)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new EventType, $event);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_event');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $event->setPicture($picture);

            if ($form->isValid()) {
                $em->flush();
            }

        }

        $artists  = $em->getRepository('VyperSiteBundle:Artist')->myFindAll();

        $view
            ->set('event', $event)
            ->set('artists', $artists)
            ->set('user_role', $this->getUserRole())
            ->set('active_event', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:Adminevent:updateEvent.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showEventsAction(Request $request)
    {
        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $events  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Event')->myFindAll();

        $view->set('events',       $events);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_event", true);

        return $this->render('VyperSiteBundle:Adminevent:showEvents.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Event $event)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($event);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Event deleted.');

        return $this->redirect($this->generateUrl('admin_show_events'));
    }
} 