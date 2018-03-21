<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MobileController extends BaseController
{
	/**
     * @Route("/mobile/{id}", name="single_mobile", requirements={"id"="\d+"})
     */
    public function indexAction(Request $request, $id)
    {
        $uri = 'api/mobiles/'.$id;

        $mobile = $this->request($uri);

        return $this->render('mobile/single.html.twig', [
            'mobile' => $mobile
        ]);
    }
}