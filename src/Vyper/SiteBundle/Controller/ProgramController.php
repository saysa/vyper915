<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\ProgramType;


class ProgramController extends Controller
{

    public function showAllProgramsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $programs= $em->getRepository('VyperSiteBundle:Program')->findAll();

        $json = array();
        foreach ($programs as $event) {

            $background = '#D35F5F';
            $border = '#891F1F';

            $date = $event->getDate()->format("Y-m-d");
            $time = $event->getStartTime()->format("H:i:s");
            $timeEnd = $event->getEndTime()->format("H:i:s");


            $opt = array(
                'title' => $event->getTitle(),
                'start' => $date.'T'.$time,
                'borderColor' => $border,
                'backgroundColor' => $background,
                'end' =>  $date.'T'.$timeEnd,
            );
            $json[] = $opt;
        }

        $defaultDate = date('Y-m-d', time());

        $view
            ->set('current_radio', true)
            ->set('programs', json_encode($json))
            ->set('defaultDate', $defaultDate)
        ;

        return $this->render('VyperSiteBundle:Program:showAllPrograms.html.twig', $view->getView());
    }

    public function showAllProgramTypesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $programTypes = $em->getRepository('VyperSiteBundle:ProgramType')->findAll();

        $view
            ->set('current_radio', true)
            ->set('programTypes', $programTypes)
        ;

        return $this->render('VyperSiteBundle:Program:showAllProgramTypes.html.twig', $view->getView());
    }

    public function showProgramTypeAction(ProgramType $programType)
    {
        $view = $this->container->get('saysa_view');

        $view->set("img_type_big", "true");
        $view->set('programType', $programType);

        return $this->render('VyperSiteBundle:Program:showProgramType.html.twig', $view->getView());
    }

}
