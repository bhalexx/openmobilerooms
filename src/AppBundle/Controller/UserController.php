<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Event\UserEvents;

class UserController extends Controller
{
    /**
     * @Route("/delete", name="delete_user")
     */
    public function deleteAction(Request $request)
    {
        //Create an empty form with only CSRF to secure user deletion
        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // Dispatch UserEvent delete to tell Bilemo API to delete ApiUser
            $this->get('event_dispatcher')->dispatch(UserEvents::USER_DELETED, new UserEvents($this->getUser()));
            return $this->redirectToRoute('mobiles');
        }

        return $this->render('user/delete.html.twig', array(
            'user' => $this->getUser(),
            'form' => $form->createView()
        ));
    }
}
