<?php


namespace Hiworks\Http;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Hiworks\Exceptions\HiworksHttpException;

/**
 * Class HiworksGuzzleClient
 * @package Hiworks\Http
 */
class HiworksGuzzleClient implements HiworksHttpClient
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var Client
     */
    private $hiworks_guzzle_client;


    /**
     * @return Client
     */
    private function getHiworksGuzzleClient()
    {
        if (!$this->hiworks_guzzle_client instanceof Client) {
            $this->hiworks_guzzle_client = new Client([
                'base_uri' => $this->host,
            ]);
        }
        return $this->hiworks_guzzle_client;
    }

    /**
     * HiworksGuzzleClient constructor.
     * @param string $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }


    /**
     * @param string $path
     * @param array $query
     * @param array $headers
     * @return mixed
     * @throws HiworksHttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($path, array $query = [], array $headers = [])
    {
        $client = $this->getHiworksGuzzleClient();
        $options = [
            RequestOptions::QUERY => $query,
            RequestOptions::HEADERS => $headers,
        ];

        if( !$guzzle_response = $client->request('GET', $path, $options)->getBody()->getContents() )
        {
            throw new HiworksHttpException("Occured error in HiworksGuzzleClient get ${$path} with ".json_encode($options));
        }

        return $this->response($guzzle_response);
    }

    /**
     * @param string $path
     * @param array $form_params
     * @param array $headers
     * @return mixed
     * @throws HiworksHttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($path, array $form_params = [], array $headers = [])
    {
        $client = $this->getHiworksGuzzleClient();
        $options = [
            RequestOptions::FORM_PARAMS => $form_params,
            RequestOptions::HEADERS => $headers,
        ];

        if( !$guzzle_response = $client->request('POST', $path, $options)->getBody()->getContents() )
        {
            throw new HiworksHttpException("Occured error in HiworksGuzzleClient post ${$path} with ".json_encode($options));
        }

        return $this->response($guzzle_response);
    }

    /**
     * @param string $path
     * @param array $form_params
     * @param array $headers
     * @return mixed
     * @throws HiworksHttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($path, array $form_params = [], array $headers = [])
    {
        $client = $this->getHiworksGuzzleClient();
        $options = [
            RequestOptions::FORM_PARAMS => $form_params,
            RequestOptions::HEADERS => $headers,
        ];

        if( !$guzzle_response = $client->request('PUT', $path, $options)->getBody()->getContents() )
        {
            throw new HiworksHttpException("Occured error in HiworksGuzzleClient put ${$path} with ".json_encode($options));
        }

        return $this->response($guzzle_response);
    }

    /**
     * @param string $path
     * @param array $form_params
     * @param array $headers
     * @return mixed
     * @throws HiworksHttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($path, array $form_params = [], array $headers = [])
    {
        $client = $this->getHiworksGuzzleClient();
        $options = [
            RequestOptions::FORM_PARAMS => $form_params,
            RequestOptions::HEADERS => $headers,
        ];

        if( !$guzzle_response = $client->request('DELETE', $path, $options)->getBody()->getContents() )
        {
            throw new HiworksHttpException("Occured error in HiworksGuzzleClient delete ${$path} with ".json_encode($options));
        }

        return $this->response($guzzle_response);
    }


    /**
     * @param $guzzle_response
     * @return mixed
     */
    private function response($guzzle_response)
    {
        $response = json_decode($guzzle_response);
        if ($response === FALSE) {
            return $guzzle_response;
        }
        return $response;
    }

}