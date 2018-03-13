<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * @Route(
     *     "/{page}", 
     *     name = "mobiles",
     *     requirements = { "page" = "\d+" },
     *     defaults = { "page" = 1 }
     * )
     */
    public function indexAction(Request $request, $page)
    {
        $client = $this->get('csa_guzzle.client.bilemo_api');
        $manufacturersUri = 'api/manufacturers';
        $mobilesUri = sprintf('api/mobiles?limit=%d&offset=%s', $this->container->getParameter('mobile_limit'), $page);
        
        $headers = [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->get('session')->get('access_token')
            ]
        ];

        $manufacturers = $client->get($manufacturersUri, $headers);
        $mobiles = $client->get($mobilesUri, $headers);

        return $this->render('home/index.html.twig', [
            'manufacturers' => json_decode($manufacturers->getBody(), true),
            'mobiles' => json_decode($mobiles->getBody(), true)
        ]);
    }

    /**
     * @Route(
     *     "/search/{manufacturer}/{page}",
     *     name="search",
     *     requirements = { "manufacturer" = "\d+", "page" = "\d+" },
     *     defaults = { "page" = 1 }
     * )
     */
    public function search(Request $request, $manufacturer, $page)
    {
        $client = $this->get('csa_guzzle.client.bilemo_api');
        $manufacturersUri = 'api/manufacturers';
        $mobilesUri = sprintf('api/mobiles?manufacturer=%d&limit=%d&offset=%s', $manufacturer, $this->container->getParameter('mobile_limit'), $page);
        
        $headers = [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer '.$this->get('session')->get('access_token')
            ]
        ];

        $manufacturers = $client->get($manufacturersUri, $headers);
        $mobiles = $client->get($mobilesUri, $headers);

        return $this->render('home/index.html.twig', [
            'manufacturers' => json_decode($manufacturers->getBody(), true),
            'mobiles' => json_decode($mobiles->getBody(), true)
        ]);
    }
}
