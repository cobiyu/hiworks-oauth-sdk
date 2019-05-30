<?php


namespace Hiworks\Http;


/**
 * Interface HiworksAuthHttpClient
 * @package Hiworks\Auth
 */
interface HiworksHttpClient
{
    /**
     * @param string $path
     * @param array $query
     * @param array $header
     * @return mixed
     */
    public function get($path, array $query = [], array $header = []);

    /**
     * @param string $path
     * @param array $form_params
     * @param array $header
     * @return mixed
     */
    public function post($path, array $form_params = [], array $header = []);

    /**
     * @param string $path
     * @param array $form_params
     * @param array $header
     * @return mixed
     */
    public function put($path, array $form_params = [], array $header = []);

    /**
     * @param string $path
     * @param array $form_params
     * @param array $header
     * @return mixed
     */
    public function delete($path, array $form_params = [], array $header = []);
}