<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 23.08.2016
 * Time: 18:57
 */

namespace LumaservSystems;


use GuzzleHttp\Client;

class LUMASERV
{
    private $httpClient;

    public function __construct(
        $credentials,
        $httpClient = null
    ) {
        $this->setHttpClient($httpClient);
    }

    /**
     * @param $httpClient \GuzzleHttp\Client
     */
    public function setHttpClient($httpClient = null) {
        $this->httpClient = $httpClient ?: new Client();
    }
}