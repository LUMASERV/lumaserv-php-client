<?php

namespace LumaservSystems;

use LumaservSystems\Exception\MalformedParameterException;

class Credentials
{
    private $token;
    private $sandbox;

    private $url;

    public function __construct($token, $sandbox)
    {
        if (!is_string($token)) {
            throw new MalformedParameterException('invalid argument');
        }

        $this->token = $token;

        switch ($sandbox) {
            case true:
                $this->sandbox = false;
                $this->url = 'https://reseller.lumaserv.com/api/v1/json/';
                break;
            case false:
                $this->sandbox = true;
                $this->url = 'https://test.reseller.lumaserv.com/api/v1/json/';
        }
    }

    public function __toString()
    {
        return sprintf(
            '[Host: %s], [Token: %s].',
            $this->url,
            $this->token
        );
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}
