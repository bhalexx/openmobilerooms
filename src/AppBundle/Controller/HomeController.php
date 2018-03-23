<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $apiClient = $this->get('app.api_client');
        $uri = sprintf('api/mobiles?limit=%d&offset=%s', $this->getParameter('mobile_limit'), $page);

        $manufacturers = $apiClient->request('api/manufacturers');
        $mobiles = $apiClient->request($uri);

        return $this->render('home/index.html.twig', [
            'manufacturers' => $manufacturers,
            'mobiles' => $mobiles
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
        $apiClient = $this->get('app.api_client');
        $uri = sprintf('api/mobiles?manufacturer=%d&limit=%d&offset=%s', $manufacturer, $this->getParameter('mobile_limit'), $page);

        $manufacturers = $apiClient->request('api/manufacturers');
        $mobiles = $apiClient->request($uri);

        return $this->render('home/index.html.twig', [
            'manufacturers' => $manufacturers,
            'mobiles' => $mobiles
        ]);
    }
}
