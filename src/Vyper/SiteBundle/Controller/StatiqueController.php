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
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     * @Template
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactForm);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {

                $name = $_POST['contact']['lastname'] . " " . $_POST['contact']['firstname'];
                $from = $_POST['contact']['email'];
                $text = $_POST['contact']['message'];
                #$dest = 'cyrielle@vyper-jmusic.com';
                $dest = 'saysabou@gmail.com';

                $corps = '
                Nom : ' . $name . '<br />
                E-Mail : ' . $from . '<br />
                Site Internet : ' . $_POST['contact']['website'] . '<br />
                Message : ' . $text . '<br />

                ';

                $message = \Swift_Message::newInstance()
                    ->setSubject('Message site web VYPER')
                    ->setFrom($from)
                    ->setTo($dest)
                    ->setBody($corps, 'text/html');

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('info', 'Merci, votre message a bien été envoyé!');
            }
        }

        return array('form' => $form->createView());
    }

    public function partenairesAction()
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(1);
        $partner_media    = $em->getRepository('VyperSiteBundle:Partner')->partnerMedia($type);
        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(2);
        $partner_event  = $em->getRepository('VyperSiteBundle:Partner')->partnerEvent($type);
        $type = $em->getRepository('VyperSiteBundle:PartnerType')->find(3);
        $partner_other  = $em->getRepository('VyperSiteBundle:Partner')->partnerOther($type);



        $view->set('partner_media',       $partner_media);
        $view->set('partner_event',     $partner_event);
        $view->set('partner_other',     $partner_other);

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
    public function magazineAction()
    {
        $view = $this->container->get('saysa_view');
        $view->set('page_magazine', true);
        return $view->getView();
    }

    /**
     * @return array
     * @Template
     */
    public function mentionsLegalesAction()
    {
        return array();
    }

    /**
     * @return array
     * @Template
     */
    public function jobsAction()
    {
        $view = $this->container->get('saysa_view');
        $view->set('page_job', true);
        return $view->getView();
    }

    /**
     * @return array
     * @Template
     */
    public function pdfAction()
    {
        $view = $this->container->get('saysa_view');
        return $view->getView();
    }

}
