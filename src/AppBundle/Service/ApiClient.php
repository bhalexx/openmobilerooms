<?php

namespace AppBundle\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Serializer\Serializer;


class ApiClient
{
    private $serializer;
	private $client;
	private $session;
	private $headers;

	public function __construct(Serializer $serializer, Client $client, $session)
	{
        $this->serializer = $serializer;
		$this->client = $client;
		$this->session = $session;
		$this->headers = $this->getHeaders();
	}

	protected function getHeaders()
    {
        return [
            'Content-type' => 'application/json',
            'Authorization' => 'Bearer '.$this->session->get('access_token')
        ];
    }

    public function request($uri, $method = 'GET', $body = array())
    {
        $response = null;

        switch ($method) {
            case 'POST':
                $request = $this->client->post($uri, [
                    'headers' => $this->headers,
                    'body' => $this->serializer->serialize($body, 'json')
                ]);
                break;
            default: // GET
                $request = $this->client->get($uri, [
                    'headers' => $this->headers,
                ]);
        }

        try {
            $response = json_decode($request->getBody(), true);
        } catch (RequestException $e) {
            dump($e);
        }

        return $response;
    }
}
