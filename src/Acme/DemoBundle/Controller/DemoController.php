<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\DemoBundle\Form\UserType;
use Acme\DemoBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Demo controller to perform users operation like add/list/view.
 */
class DemoController extends Controller
{
    /**
     * @Route("/", name="demo_list_user")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AcmeDemoBundle:User')->findAll();

        return array('users' => $users);
    }

    /**
     * viewuser to see particular user information.
     *
     * @Route("/viewuser", name="demo_view_user")
     * @Method("GET")
     *
     * @return Response $response
     */
    public function viewuserAction(Request $request)
    {
        // get user id
        $userid = $request->get('userid');

        // create entity manager object.
        $em = $this->getDoctrine()->getManager();

        // check users exist or not.
        $user = $em->getRepository('AcmeDemoBundle:User')->find($userid);
        $userArr = array();
        if (count($user) > 0) {
            $userArr = array(
                'success' => true, 'id' => $user->getId(), 'username' => $user->getUsername(), 'registrationdate' => $user->getRegistrationDate()
            );
        }

        $response = new Response();
        // create a JSON-response
        $response->headers->set('Content-Type', 'application/json');
        // set json content
        $response->setContent(json_encode($userArr));
        // return json response.
        return $response;
    }

    /**
     * @Route("/adduser", name="demo_add_user")
     * @Template()
     */
    public function adduserAction()
    {
        $form = $this->get('form.factory')->create(new UserType());

        $user  = new User();
        $form = $this->createForm(new UserType(), $user);

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // if ajax request than return json response.
                if($request->isXmlHttpRequest()) {
                     $response = new Response();
                     $output = array('success' => true, 'id' => $user->getId(), 'username' => $user->getUsername(), 'registrationdate' => $user->getRegistrationDate());
                     $response->headers->set('Content-Type', 'application/json');
                     // set json content
                     $response->setContent(json_encode($output));

                     // return json response.
                     return $response;
                }

                // if no ajax request than redirect to user listing page.
                return $this->redirect($this->generateUrl('demo_list_user'));
            }
        }

        return array('form' => $form->createView());
    }
}
