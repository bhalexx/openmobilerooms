<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends BaseController
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
        $uri = sprintf('api/mobiles?limit=%d&offset=%s', $this->container->getParameter('mobile_limit'), $page);

        $manufacturers = $this->request('api/manufacturers');
        $mobiles = $this->request($uri);

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
        $uri = sprintf('api/mobiles?manufacturer=%d&limit=%d&offset=%s', $manufacturer, $this->container->getParameter('mobile_limit'), $page);

        $manufacturers = $this->request('api/manufacturers');
        $mobiles = $this->request($uri);

        return $this->render('home/index.html.twig', [
            'manufacturers' => $manufacturers,
            'mobiles' => $mobiles
        ]);
    }
}
