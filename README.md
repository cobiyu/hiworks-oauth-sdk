# Hiworks Oauth SDK for PHP
[![Build Status](https://travis-ci.org/cobiyu/hiworks-oauth-sdk.svg?branch=master)](https://travis-ci.org/cobiyu/hiworks-oauth-sdk)
[![Latest Stable Version](https://poser.pugx.org/cobiyu/hiworks-oauth-sdk/version)](https://packagist.org/packages/cobiyu/hiworks-oauth-sdk)
[![License](https://poser.pugx.org/cobiyu/hiworks-oauth-sdk/license)](https://packagist.org/packages/cobiyu/hiworks-oauth-sdk)


Hiworks Oauth v2 PHP 연동 모듈

## Install
```sh
composer require cobiyu/hiworks-oauth-sdk
```

## Usage
> **Note:** Note: This version of this SDK for PHP requires **PHP 5.6** or greater.

> **Doc Link:** https://documenter.getpostman.com/view/6863253/S1TVWcri?version=latest#intro 
### Generate Hiworks SDK instance 
```php
$client = new \Hiworks\Hiworks($app_client_id,$app_password);
```
### Get Access Token using Authorization Code
```php
$client = new \Hiworks\Hiworks($app_client_id,$app_password);

// getAccessToken return Hiworks\Auth\AccessToken instance.
// $auth_code is received parameter(name:auth_code) in your app's callback.
$access_token = $client->getAccessToken->getAccessToken($auth_code);

echo $access_token->getAccessToken();   // print access_toekn (example. fh283nfdsialvcxzvclxzvcxz)
```

### Get response Hiworks API using access token
```php
// $path and $access token must be string.
// api result is object.
$get_response = $client->get($path, $access_token)
$post_response = $client->post($path, $access_token)
$put_response = $client->put($path, $access_token)
$delete_response = $client->delete($path, $access_token)
```

### Exception
-- **Hiworks\Exceptions\HiworksSDKException** : package의 최상위 Exception 
> 자세한 exception 내용이 필요하다면 , *Hiworks\Exceptions* 참조
```php
catch(HiworksSDKException $e)
{
    /// some logic
}
```