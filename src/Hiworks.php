<?php


namespace Hiworks;

use Hiworks\Auth\AccessToken;
use Hiworks\Auth\HiworksAuthClient;
use Hiworks\Exceptions\HiworksSDKException;
use Hiworks\Http\HiworksGuzzleClient;
use Hiworks\Http\HiworksHttpClient;

/**
 * Class Hiworks
 * @package Hiworks
 */
class Hiworks
{
    /**
     * @var string
     */
    private $app_client_id;
    /**
     * @var string
     */
    private $api_secret;
    /**
     * @var AccessToken
     */
    private $access_token;
    /**
     * @var HiworksHttpClient
     */
    private $hiworks_http_client;

    /**
     * @var HiworksAuthClient
     */
    private $hiworks_auth_client;

    /**
     * @var HiworksApiClient
     */
    private $hiworks_api_client;

    /**
     * @var string
     */
    const HIWORKS_API_HOST = 'https://api.hiworks.com';

    /**
     * Hiworks constructor.
     * @param string $app_client_id
     * @param string $api_secret
     * @throws HiworksSDKException
     */
    public function __construct($app_client_id=null, $api_secret=null)
    {
        $this->app_client_id = $app_client_id;
        $this->api_secret = $api_secret;

        if (empty($this->app_client_id)) {
            throw new HiworksSDKException('Required "app_client_id" key not supplied in first parameter');
        }
        if (empty($this->api_secret)) {
            throw new HiworksSDKException('Required "api_secret" key not supplied in second parameter');
        }

        $this->hiworks_http_client = new HiworksGuzzleClient(self::HIWORKS_API_HOST);
    }

    /**
     * @return HiworksAuthClient
     * @throws Exceptions\HiworksAuthException
     */
    private function getHiworksAuthClient()
    {
        if (!$this->hiworks_auth_client instanceof HiworksAuthClient) {
            $this->hiworks_auth_client = new HiworksAuthClient(
                $this->hiworks_http_client,
                self::HIWORKS_API_HOST,
                $this->app_client_id,
                $this->api_secret
            );
        }

        return $this->hiworks_auth_client;
    }

    /**
     * @return HiworksApiClient
     */
    private function getHiworksApiClient()
    {
        if (!$this->hiworks_api_client instanceof HiworksApiClient) {
            $this->hiworks_api_client = new HiworksApiClient(
                $this->hiworks_http_client,
                self::HIWORKS_API_HOST
            );
        }

        return $this->hiworks_api_client;
    }

    /**
     * @return string
     * @throws Exceptions\HiworksAuthException
     */
    public function getSignInUrl()
    {
        $hiworks_auth_client = $this->getHiworksAuthClient();

        return $hiworks_auth_client->getSignInUrl();
    }


    /**
     * @param $auth_code
     * @return AccessToken
     * @throws Exceptions\HiworksAuthException
     * @throws HiworksSDKException
     */
    public function getAccessToken($auth_code)
    {
        if(empty($auth_code)){
            throw new HiworksSDKException('Required "auth_code" key not supplied in Hiworks\Hiworks :: getAccessToken() first parameter');
        }
        $hiworks_auth_client = $this->getHiworksAuthClient();

        return $hiworks_auth_client->getAccessToken($auth_code);
    }

    /**
     * @param $refresh_token
     * @return AccessToken
     * @throws Exceptions\HiworksAuthException
     * @throws HiworksSDKException
     */
    public function getRenewAccessToken($refresh_token)
    {
        if(empty($refresh_token)){
            throw new HiworksSDKException('Required "refresh_token" key not supplied in Hiworks\Hiworks :: getRenewAccessToken() first parameter');
        }
        $hiworks_auth_client = $this->getHiworksAuthClient();

        return $hiworks_auth_client->getRenewAccessToken($refresh_token);
    }

    /**
     * @param $path
     * @param array $query
     * @param null $access_token
     * @return mixed
     * @throws HiworksSDKException
     */
    public function get($path, $query=[], $access_token=null)
    {
        if(empty($access_token)){
            throw new HiworksSDKException('Required "access_token" key not supplied in Hiworks\Hiworks :: get() third parameter');
        }

        $hiworks_api_client = $this->getHiworksApiClient();

        return $hiworks_api_client->get(
            $path,
            $query,
            $access_token
        );
    }

    /**
     * @param $path
     * @param array $form_params
     * @param null $access_token
     * @return mixed
     * @throws Exceptions\HiworksApiException
     * @throws HiworksSDKException
     */
    public function post($path, $form_params=[], $access_token=null)
    {
        if(empty($access_token)){
            throw new HiworksSDKException('Required "access_token" key not supplied in Hiworks\Hiworks :: post() third parameter');
        }

        $hiworks_api_client = $this->getHiworksApiClient();

        return $hiworks_api_client->post(
            $path,
            $form_params,
            $access_token
        );
    }

    /**
     * @param $path
     * @param array $form_params
     * @param null $access_token
     * @return mixed
     * @throws HiworksSDKException
     */
    public function put($path, $form_params=[], $access_token=null)
    {
        if(empty($access_token)){
            throw new HiworksSDKException('Required "access_token" key not supplied in Hiworks\Hiworks :: put() third parameter');
        }

        $hiworks_api_client = $this->getHiworksApiClient();

        return $hiworks_api_client->put(
            $path,
            $form_params,
            $access_token
        );
    }

    /**
     * @param $path
     * @param array $form_params
     * @param null $access_token
     * @return mixed
     * @throws HiworksSDKException
     */
    public function delete($path, $form_params=[], $access_token=null)
    {
        if(empty($access_token)){
            throw new HiworksSDKException('Required "access_token" key not supplied in Hiworks\Hiworks :: delete() third parameter');
        }

        $hiworks_api_client = $this->getHiworksApiClient();

        return $hiworks_api_client->delete(
            $path,
            $form_params,
            $access_token
        );
    }


}