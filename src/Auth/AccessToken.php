<?php


namespace Hiworks\Auth;


/**
 * Class AccessToken
 * @package Hiworks\Auth
 */
class AccessToken
{
    /**
     * @var string
     */
    private $access_token;
    /**
     * @var string
     */
    private $refresh_token;
    /**
     * @var string
     */
    private $office_no;
    /**
     * @var string
     */
    private $user_no;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * @param string $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }

    /**
     * @return string
     */
    public function getOfficeNo()
    {
        return $this->office_no;
    }

    /**
     * @param string $office_no
     */
    public function setOfficeNo($office_no)
    {
        $this->office_no = $office_no;
    }

    /**
     * @return string
     */
    public function getUserNo()
    {
        return $this->user_no;
    }

    /**
     * @param string $user_no
     */
    public function setUserNo($user_no)
    {
        $this->user_no = $user_no;
    }


}