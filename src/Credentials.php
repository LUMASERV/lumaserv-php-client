<?php

namespace LumaservSystems;

class Credentials
{
    private $token;
    private $debug;

    private $url;

    public function __construct($token, $debug)
    {
        if (!is_string($token)) {
            throw new MalformedParameterException('invalid argument');
        }

        $this->token = $token;

        switch ($debug) {
            case true:
                $this->debug = false;
                $this->url = 'https://reseller.lumaserv.com/api/json';
                break;
            case false:
                $this->debug = true;
                $this->url = 'https://test.reseller.lumaserv.com/api/json';
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
     * @return bool
     */
    public function isDebug()
    {
        return $this->debug;
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
