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
use Vyper\SiteBundle\Entity\Contest;
use Vyper\SiteBundle\Form\ContestType;

class AdminContestController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addContestAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $contest = new Contest;
        $form = $this->createForm(new ContestType, $contest);

        if ($request->getMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $post_data = $request->request->get('vyper_sitebundle_contest');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $contest->setPicture($picture);

            if ($form->isValid()) {

                $em->persist($contest);
                $em->flush();

                $request->getSession()->getFlashBag()->add('info', 'Contest added.');
                return $this->redirect($this->generateUrl('vyper_site_admin_show_contests'));
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('user_role', $this->getUserRole())
            ->set('active_event', true)
        ;

        return $this->render('VyperSiteBundle:AdminContest:addContest.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Contest $contest
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateContestAction(Request $request, Contest $contest)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new ContestType, $contest);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_contest');

            $form->submit($request);

            $picture = $em->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $contest->setPicture($picture);

            if ($form->isValid()) {
                $em->flush();
            }

        }

        $view
            ->set('contest', $contest)
            ->set('user_role', $this->getUserRole())
            ->set('active_event', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminContest:updateContest.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showContestsAction(Request $request)
    {
        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $contests  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Contest')->myFindAll();

        $view->set('contests',       $contests);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_event", true);

        return $this->render('VyperSiteBundle:AdminContest:showContests.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Contest $contest
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Contest $contest)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($contest);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Contest deleted.');

        return $this->redirect($this->generateUrl('vyper_site_admin_show_contests'));
    }
} 