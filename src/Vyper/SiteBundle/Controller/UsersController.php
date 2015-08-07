<?php

namespace Vyper\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vyper\SiteBundle\Form\Login\Login;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $view = $this->container->get('saysa_view');
        $form = $this->get('form.factory')->create(new Login());
        if ('POST' === $request->getMethod()) {

            $form->handleRequest($request);
            $data = $form->getData();

            $email = $data['email'];
            $password = $data['password'];


            if (!$this->match($email, $password))
            {
                $view->set("password_error", "Email adress and/or password are incorrect");
            }
            else
            {
                $session = $request->getSession();
                $session->set('user', $this->match($email, $password));

                return $this->redirect($this->generateUrl('home'));

            }
        }

        $view->set('form', $form->createView());

        return $this->render('VyperSiteBundle:Users:login.html.twig', $view->getView());
    }

    public function match($login, $password)
    {
        $user_repository = $this->getDoctrine()->getManager()->getRepository('VyperSiteBundle:User');
        $user = $user_repository->findOneBy(array(
            "login" => $login,
            "password" => $password,
            "live" => true,
            "deleted" => false
        ));

        if (!is_null($user))
        {
            return $user->getId();
        }

        return false;
    }

}
