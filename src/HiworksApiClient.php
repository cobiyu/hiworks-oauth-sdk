<?php


namespace Hiworks;


use Hiworks\Exceptions\HiworksApiException;
use Hiworks\Http\HiworksHttpClient;

/**
 * Class HiworksApiClient
 * @package Hiworks
 */
class HiworksApiClient
{
    /**
     * @var string $host
     */
    private $host;

    /**
     * @var HiworksHttpClient $hiworks_api_guzzle_client
     */
    private $hiworks_http_client;

    /**
     * HiworksApiClient constructor.
     * @param string $host
     * @param HiworksHttpClient $hiworks_http_client
     */
    public function __construct(HiworksHttpClient $hiworks_http_client, $host)
    {
        $this->hiworks_http_client = $hiworks_http_client;
        $this->host = $host;
    }


    /**
     * @param string $access_token
     * @return array
     * @throws HiworksApiException
     */
    public function getHeader($access_token)
    {
        if(empty($access_token)){
            throw new HiworksApiException('Required "access_token" key not supplied in Hiworks\HiworksApiClient :: getHeader() first parameter');
        }

        return [
            'Authorization' => "Bearer {$access_token}",
            'Content-Type'  => 'application/json',
        ];
    }

    /**
     * @param string $path
     * @param array $query
     * @param null $access_token
     * @return mixed
     * @throws HiworksApiException
     */
    public function get($path, $query=[], $access_token=null)
    {
        if(empty($access_token)){
            throw new HiworksApiException('Required "access_token" key not supplied in Hiworks\HiworksApiClient :: get() third parameter');
        }

        return $this->hiworks_http_client->get(
            $path,
            $query,
            $this->getHeader($access_token)
        );
    }

    public function post($path, $form_params=[], $access_token=null)
    {
        if(empty($access_token)){
            throw new HiworksApiException('Required "access_token" key not supplied in Hiworks\HiworksApiClient :: post() third parameter');
        }

        return $this->hiworks_http_client->post(
            $path,
            $form_params,
            $this->getHeader($access_token)
        );
    }

}