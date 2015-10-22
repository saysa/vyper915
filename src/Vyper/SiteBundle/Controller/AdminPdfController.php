<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Pdf;
use Vyper\SiteBundle\Form\PdfType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminPdfController extends AdminCommonController {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showPdfsAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $em = $this->getDoctrine()->getManager();

        // Get all the articles not deleted
        $pdfs  = $em->getRepository('VyperSiteBundle:Pdf')->myFindAll();

        $view->set('pdfs',       $pdfs);
        $view->set('user_role', $this->getUserRole());
        $view->set("active_pdf", true);

        return $this->render('VyperSiteBundle:AdminPdf:showPdfs.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addPdfAction(Request $request)
    {

        $view = $this->container->get('saysa_view');
        $pdf = new Pdf();
        $form = $this->createForm(new PdfType(), $pdf);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($pdf);
                $em->flush();
            }
            $request->getSession()->getFlashBag()->add('info', 'PDF file added.');
            return $this->redirect($this->generateUrl('admin_show_pdfs'));
        }

        $view->set('form', $form->createView());
        $view->set('user_role', $this->getUserRole());
        $view->set("active_pdf", true);

        return $this->render('VyperSiteBundle:AdminPdf:addPdf.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param Pdf $pdf
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request, Pdf $pdf)
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('VyperSiteBundle:Article')->getByPdfId($pdf->getId());



        if (sizeof($articles)>0) {
            $request->getSession()->getFlashBag()->add('info', 'The PDF file is used in Article.');
        } else {
            $em->remove($pdf);
            $em->flush();

            if(is_file(__DIR__ . "/../../../../web/" . $pdf->getPath())) {
                unlink(__DIR__ . "/../../../../web/" . $pdf->getPath());
            }

            $request->getSession()->getFlashBag()->add('info', 'PDF file deleted.');
        }

        return $this->redirect($this->generateUrl('admin_show_pdfs'));
    }
} 