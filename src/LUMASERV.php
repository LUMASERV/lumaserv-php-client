<?php

namespace LumaservSystems;

use GuzzleHttp\Client;
use LumaservSystems\Exception\MalformedParameterException;
use Psr\Http\Message\ResponseInterface;

class LUMASERV
{
    private $httpClient;
    private $credentials;

    /**
     * LUMASERV constructor.
     *
     * @param $credentials Credentials|string
     * @param bool $debug
     * @param null $httpClient
     */
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
    public function setHttpClient($httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Client();
    }

    public function setCredentials($credentials, $debug)
    {
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

    /**
     * @param string $actionPath The resource path you want to request, see more at the documentation.
     * @param array  $params     Array filled with request params
     * @param string $method     HTTP method used in the request
     *
     * @throws MalformedParameterException If the given field in params is not an array
     *
     * @return ResponseInterface
     */
    private function request($actionPath, $params = [], $method = 'GET')
    {
        $url = $this->getCredentials()->getUrl().$actionPath;

        if (!is_array($params)) {
            throw new MalformedParameterException();
        }

        $params['api_token'] = $this->getCredentials()->getToken();

        switch ($method) {
            case 'GET':
                return $this->getHttpClient()->get($url, [
                    'verify' => false,
                    'query'  => $params,
                ]);
                break;
            case 'POST':
                return $this->getHttpClient()->post($url, [
                    'verify' => false,
                    'body'   => $params,
                ]);
                break;
            case 'PUT':
                return $this->getHttpClient()->put($url, [
                    'verify' => false,
                    'body'   => $params,
                ]);
            case 'DELETE':
                return $this->getHttpClient()->delete($url, [
                    'verify' => false,
                    'body'   => $params,
                ]);
            default:
                throw new MalformedParameterException('Wrong HTTP method passed');
        }
    }

    /**
     * @param $response ResponseInterface
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    private function processRequest($response)
    {
        $response = $response->getBody()->__toString();
        $result = json_decode($response);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $result;
        } else {
            return $response;
        }
    }

    public function get($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params);

        return $this->processRequest($response);
    }

    public function put($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'PUT');

        return $this->processRequest($response);
    }

    public function post($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'POST');

        return $this->processRequest($response);
    }

    public function delete($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'DELETE');

        return $this->processRequest($response);
    }

    public function getUrl($actionPath = '')
    {
        return $this->getCredentials()->getUrl().$actionPath;
    }

    public function getAllDomains()
    {
        return $this->get('domains');
    }

    public function isDomainAvailable($sld, $tld)
    {
        return $this->get('domains/check', [
            'sld' => $sld,
            'tld' => $tld,
        ]);
    }

    public function getDomainPrices()
    {
        return $this->get('domains/prices');
    }
}
