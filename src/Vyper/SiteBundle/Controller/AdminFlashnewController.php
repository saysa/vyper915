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
use Vyper\SiteBundle\Entity\Flashnew;
use Vyper\SiteBundle\Form\FlashnewType;

class AdminFlashnewController extends AdminCommonController {


    public function deleteFlashnewAction(Flashnew $flashnew)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($flashnew);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_show_articles'));
    }

    public function addFlashnewAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $flashnew = new Flashnew();
        $form = $this->createForm(new FlashnewType, $flashnew);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($flashnew);
                $em->flush();
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('active_article', true)
        ;

        return $this->render('VyperSiteBundle:Adminflashnew:addFlashnew.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Flashnew $flashnew
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateFlashnewAction(Request $request, Flashnew $flashnew)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new FlashnewType, $flashnew);

        if ('POST' === $request->getMethod()) {

            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

        }

        $view
            ->set('flashnew', $flashnew)
            ->set('active_article', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:Adminflashnew:updateFlashnew.html.twig', $view->getView());
    }
} 