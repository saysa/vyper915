<?php
/**
 * Created by PhpStorm.
 * User: Saysa
 * Date: 10/08/14
 * Time: 13:55
 */

namespace Vyper\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vyper\SiteBundle\Entity\Article;
use Vyper\SiteBundle\Entity\Editable;
use Vyper\SiteBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Vyper\SiteBundle\Form\EditableType;

class AdminEditableController extends AdminCommonController {


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $view = $this->container->get('saysa_view');

        // Get all the articles not deleted
        $editables     = $em->getRepository('VyperSiteBundle:Editable')->findAll();

        $view->set('editables', $editables);
        $view->set("active_editable", true);

        return $this->render('VyperSiteBundle:AdminEditable:showAll.html.twig', $view->getView());
    }



    /**
     * @param Request $request
     * @param Editable $editable
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateAction(Request $request, Editable $editable)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $this->container->get('saysa_view');

        $form = $this->createForm(new EditableType, $editable);

        if ('POST' === $request->getMethod()) {

            $post_data = $request->request->get('vyper_sitebundle_editable');

            $form->submit($request);

            if ($form->isValid()) {
                $em->flush();
            }
        }

        $view
            ->set('editable', $editable)
            ->set('active_editable', true)
            ->set('form', $form->createView())
        ;

        return $this->render('VyperSiteBundle:AdminEditable:update.html.twig', $view->getView());
    }


} 