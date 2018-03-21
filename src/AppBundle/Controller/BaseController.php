<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BaseController extends Controller
{
    protected function getHttpClient()
    {
        return $this->get('csa_guzzle.client.bilemo_api');
    }

    protected function getHeaders()
    {
        return [
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer '.$this->get('session')->get('access_token')
        ];
    }

    protected function request($uri, $method = 'GET', $body = array())
    {
        $response = null;

        $request = $this->getHttpClient()->get($uri, [
            'headers' => $this->getHeaders()
        ]);

        try {
            $response = json_decode($request->getBody(), true);
        } catch (RequestException $e) {
            dump($e);
        }

        return $response;
    }
}
