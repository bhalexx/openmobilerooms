<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $client = $this->get('csa_guzzle.client.bilemo_api');
        $uri = 'api/manufacturers';
        
        $manufacturers = $client->get($uri, [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->get('session')->get('access_token')
            ]
        ]);

        return $this->render('home/index.html.twig', [
            // 'manufacturers' => json_decode($manufacturers->getBody(), true)
        ]);
    }
}
