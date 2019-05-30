<?php


namespace Hiworks\Auth;


use Hiworks\Exceptions\HiworksAuthException;
use Hiworks\Http\HiworksHttpClient;

/**
 * Class HiworksAuthClient
 * @package Hiworks\Auth
 */
class HiworksAuthClient
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $app_client_id;
    /**
     * @var string
     */
    private $api_secret;

    /**
     * @var HiworksHttpClient
     */
    private $hiworks_auth_http_client;

    /**
     * string SIGN_IN_PATH
     */
    const SIGN_IN_PATH = '/open/auth/authform';
    /**
     * string ACCESS_TOKEN_PATH
     */
    const ACCESS_TOKEN_PATH = '/open/auth/accesstoken';

    /**
     * @var string
     */
    const ACCESS_TYPE = 'offline';

    /**
     * @var string
     */
    const RENEW_ACCESS_TYPE = 'offline';

    /**
     * @var string
     */
    const SUCCESS_CODE = 'SUC';

    /**
     * HiworksAuthClient constructor.
     * @param HiworksHttpClient $hiworks_auth_http_client
     * @param string $host
     * @param string $app_client_id
     * @param string $api_secret
     * @throws HiworksAuthException
     */
    public function __construct($hiworks_auth_http_client, $host, $app_client_id=null, $api_secret=null)
    {
        $this->hiworks_auth_http_client = $hiworks_auth_http_client;
        $this->host = $host;
        $this->app_client_id = $app_client_id;
        $this->api_secret = $api_secret;

        if (empty($this->host)) {
            throw new HiworksAuthException('Required "host" key not supplied in HiworksAuthClient first parameter');
        }
        if (empty($this->app_client_id)) {
            throw new HiworksAuthException('Required "app_client_id" key not supplied in HiworksAuthClient first parameter');
        }
        if (empty($this->api_secret)) {
            throw new HiworksAuthException('Required "api_secret" key not supplied in HiworksAuthClient second parameter');
        }
    }

    /**
     * @return string
     */
    public function getSignInUrl()
    {
        return $this->host.self::SIGN_IN_URL."?client_id=".$this->app_client_id."&access_type=offline";
    }

    /**
     * @param string $auth_code
     * @return AccessToken
     * @throws HiworksAuthException
     */
    public function getAccessToken($auth_code)
    {
        if (empty($auth_code)) {
            throw new HiworksAuthException('Required "auth_code" not supplied in HiworksAuthClient :: getAccessToken second parameter');
        }

        $form_params = [
            'client_id' => $this->app_client_id,
            'client_secret' => $this->api_secret,
            'grant_type' => 'authorization_code',
            'auth_code' => $auth_code,
            'access_type' => $this->app_client_id,
        ];

        $response = $this->hiworks_auth_http_client->post(self::ACCESS_TOKEN_PATH, $form_params);

        if($response->code !== self::SUCCESS_CODE){
            throw new HiworksAuthException('getAccessToken response code is '.$response->code." :: ".$response->msg);
        }

        $access_token = new AccessToken();
        $access_token->setAccessToken($response->data->access_token);
        $access_token->setRefreshToken($response->data->refresh_token);
        $access_token->setOfficeNo($response->data->office_no);
        $access_token->setUserNo($response->data->user_no);

        return $access_token;
    }

    /**
     * @param string $refresh_token
     * @return AccessToken
     * @throws HiworksAuthException
     */
    public function getRenewAccessToken($refresh_token)
    {
        if (empty($refresh_token)) {
            throw new HiworksAuthException('Required "refresh_token" not supplied in HiworksAuthClient :: getRenewAccessToken second parameter');
        }


        $form_params = [
            'client_id' => $this->app_client_id,
            'client_secret' => $this->api_secret,
            'grant_type' => 'authorization_code',
            'refresh_token' => $refresh_token,
            'access_type' => $this->app_client_id,
        ];

        $response = $this->hiworks_auth_http_client->post(self::ACCESS_TOKEN_PATH, $form_params);

        if($response->code !== 'SUC'){
            throw new HiworksAuthException('getRenewAccessToken response code is '.$response->code." :: ".$response->msg);
        }

        $access_Token = new AccessToken();
        $access_Token->setAccessToken($response->data->access_token);
        $access_Token->setRefreshToken($response->data->refresh_token);
        $access_Token->setOfficeNo($response->data->office_no);
        $access_Token->setUserNo($response->data->user_no);

        return $access_Token;
    }



}