<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 23.08.2016
 * Time: 19:09
 */

namespace LumaservSystems;


class Credentials
{
    private $username;
    private $password;
    private $debug;

    private $url;

    public function __construct($credentials, $debug)
    {
        $this->username = $credentials[0];
        $this->password = $credentials[1];

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
}