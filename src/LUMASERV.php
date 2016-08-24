<?php

namespace LumaservSystems;

use GuzzleHttp\Client;

class LUMASERV
{
    private $httpClient;
    private $credentials;

    private $testing;

    public function __construct(
        $credentials,
        $debug = false,
        $httpClient = null
    ) {
        $this->setHttpClient($httpClient);
        $this->setCredentials($credentials, $debug);
    }

    /**
     * @param $httpClient \GuzzleHttp\Client
     */
    public function setHttpClient($httpClient = null) {
        $this->httpClient = $httpClient ?: new Client();
    }

    public function setCredentials($credentials, $debug) {
        if (!$credentials instanceof Credentials) {
            $credentials = new Credentials($credentials, $debug);
        }

        $this->credentials = $credentials;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @return Credentials
     */
    private function getCredentials()
    {
        return $this->credentials;
    }
}