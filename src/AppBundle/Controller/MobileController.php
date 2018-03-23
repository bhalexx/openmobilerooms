<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MobileController extends Controller
{
	/**
     * @Route("/mobile/{id}", name="single_mobile", requirements={"id"="\d+"})
     */
    public function indexAction(Request $request, $id)
    {
        $apiClient = $this->get('app.api_client');
        $uri = 'api/mobiles/'.$id;

        $mobile = $apiClient->request($uri);

        return $this->render('mobile/single.html.twig', [
            'mobile' => $mobile
        ]);
    }
}