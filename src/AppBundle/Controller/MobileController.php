<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

class MobileController extends Controller
{
	/**
     * @Route("/mobile/{id}", name="single_mobile", requirements={"id"="\d+"})
     */
    public function indexAction(Request $request, $id)
    {
        $client = $this->get('csa_guzzle.client.bilemo_api');
        $uri = 'api/mobiles/'.$id;
        
        $headers = [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->get('session')->get('access_token')
            ]
        ];

        $mobile = $client->get($uri, $headers);

        return $this->render('mobile/single.html.twig', [
            'mobile' => json_decode($mobile->getBody(), true)
        ]);
    }
}