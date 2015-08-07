<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Program;
use Vyper\SiteBundle\Entity\ProgramType;
use Vyper\SiteBundle\Form\ProgramTypeType;

class AdminProgramController extends AdminCommonController {

    public function addProgramAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $program = new Program;
        $form = $this->createForm(new \Vyper\SiteBundle\Form\ProgramType, $program);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($program);
                $em->flush();
            }
        }

        $view
            ->set('form', $form->createView())
            ->set('active_program', true)
        ;

        return $this->render('VyperSiteBundle:AdminProgram:addProgram.html.twig', $view->getView());
    }

    public function updateProgramAction(Request $request, Program $program)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new \Vyper\SiteBundle\Form\ProgramType, $program);

        if ('POST' === $request->getMethod()) {

            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

        }

        $view
            ->set('program', $program)
            ->set('active_program', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminProgram:updateProgram.html.twig', $view->getView());
    }

    public function addProgramTypeAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $programType = new ProgramType;
        $form = $this->createForm(new ProgramTypeType, $programType);

        if ($request->getMethod() == 'POST') {

            $post_data = $request->request->get('vyper_sitebundle_programType');

            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $programType->setPicture($picture);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($programType);
                $em->flush();
            }

        }

        $view
            ->set('form', $form->createView())
            ->set('active_program', true)
        ;

        return $this->render('VyperSiteBundle:AdminProgram:addProgramType.html.twig', $view->getView());
    }

    /**
     * @param Request $request
     * @param ProgramType $programType
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateProgramTypeAction(Request $request, ProgramType $programType)
    {
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new ProgramTypeType, $programType);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_programType');

            $form->submit($request);

            $picture = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Picture')->find($post_data['pictureID']);

            $programType->setPicture($picture);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }

        }

        $view
            ->set('programType', $programType)
            ->set('active_program', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminProgram:updateProgramType.html.twig', $view->getView());
    }

    public function showProgramsAction()
    {
        $view = $this->container->get('saysa_view');

        $programs  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:Program')->findAll();
        $programTypes  = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:ProgramType')->findAll();

        $view
            ->set('programs',       $programs)
            ->set('programTypes',       $programTypes)
            ->set("active_program", true)
        ;

        return $this->render('VyperSiteBundle:AdminProgram:showPrograms.html.twig', $view->getView());
    }
} 