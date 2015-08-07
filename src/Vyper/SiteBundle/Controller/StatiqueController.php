<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Vyper\SiteBundle\Form\ContactForm;

class StatiqueController extends Controller
{
    /**
     * @Template()
     */
    public function radioAction()
    {
        return array();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aProposAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $editable = $em->getRepository('VyperSiteBundle:Editable')->findByName('A propos');
        $view
            ->set('editable', $editable)
        ;
        return $this->render('VyperSiteBundle:Statique:aPropos.html.twig', $view->getView());
    }

    public function lEquipeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');
        $editable = $em->getRepository('VyperSiteBundle:Editable')->findByName("L'equipe");
        $view
            ->set('editable', $editable)
        ;
        return $this->render('VyperSiteBundle:Statique:lEquipe.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return array
     * @Template
     */
    public function contactAction(Request $request)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new ContactForm);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $sujet = $_POST['contact']['sujet'];
                $name = $_POST['contact']['name'];
                $societe = $_POST['contact']['societe'];
                $from = $_POST['contact']['email'];
                $msg = $_POST['contact']['message'];
                $dest = $_POST['objet'] . '@japanfm.fr';
                #$dest = 'saysa_bounkhong@hotmail.com';

                $corps = '
                Nom et prénom : ' . $name . '<br />
                Société : ' . $societe . '<br />
                Corps : <br />
                ' . nl2br($msg) . '
                ';

                $message = \Swift_Message::newInstance()
                    ->setSubject($sujet)
                    ->setFrom($from)
                    ->setTo($dest)
                    ->setBody($corps, 'text/html');

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('info', 'Merci, nous vous répondrons dans les meilleurs délais!');
            }

        }

        $view
            ->set('form', $form->createView())
        ;
        return $view->getView();
    }

    public function partenairesAction()
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(1);
        $partner_media    = $em->getRepository('VyperSiteBundle:Partner')->partnerMedia($type);
        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(2);
        $partner_event  = $em->getRepository('VyperSiteBundle:Partner')->partnerEvent($type);



        $view->set('partner_media',       $partner_media);
        $view->set('partner_event',     $partner_event);

        return $this->render('VyperSiteBundle:Statique:partenaires.html.twig', $view->getView());
    }

    public function cguAction()
    {
        return $this->render('VyperSiteBundle:Statique:cgu.html.twig');
    }

    /**
     * @return array
     * @Template
     */
    public function cguSmsAction()
    {
        return array();
    }

    /**
     * @return array
     * @Template
     */
    public function mentionsLegalesAction()
    {
        return array();
    }

}
