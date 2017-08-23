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
        $this->httpClient = $httpClient ?: new Client([
            'allow_redirects' => false,
            'timeout' => 120
        ]);
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
                    'query'  => [
                        'api_token' => $this->getCredentials()->getToken(),
                    ],
                    'form_params'   => $params,
                ]);
                break;
            case 'PUT':
                return $this->getHttpClient()->put($url, [
                    'verify' => false,
                    'query'  => [
                        'api_token' => $this->getCredentials()->getToken(),
                    ],
                    'form_params'   => $params,
                ]);
            case 'DELETE':
                return $this->getHttpClient()->delete($url, [
                    'verify' => false,
                    'query'  => [
                        'api_token' => $this->getCredentials()->getToken(),
                    ],
                    'form_params'   => $params,
                ]);
            default:
                throw new MalformedParameterException('Wrong HTTP method passed');
        }
    }

    /**
     * @param $response ResponseInterface
     *
     * @return array|string
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

    /**
     * @param string $actionPath api domain path
     *
     * @return string full api domain based on the api domain path
     */
    public function getUrl($actionPath = '')
    {
        return $this->getCredentials()->getUrl().$actionPath;
    }

    /**
     * @deprecated
     *
     * @return array|string
     */
    public function getAllDomains()
    {
        return $this->domains()->getAll();
    }

    /**
     * @deprecated
     *
     * @param $sld
     * @param $tld
     *
     * @return array|string
     */
    public function isDomainAvailable($sld, $tld)
    {
        return $this->domains()->isAvailable($sld, $tld);
    }

    /**
     * @deprecated
     *
     * @return array|string
     */
    public function getDomainPrices()
    {
        return $this->domains()->getPrices();
    }

    private $domainHandler;

    /**
     * @return DomainHandler
     */
    public function domains()
    {
        if (!$this->domainHandler) {
            $this->domainHandler = new DomainHandler($this);
        }

        return $this->domainHandler;
    }

    private $paymentHandler;

    /**
     * @return PaymentHandler
     */
    public function payments()
    {
        if (!$this->paymentHandler) {
            $this->paymentHandler = new PaymentHandler($this);
        }

        return $this->paymentHandler;
    }

    private $trafficHandler;

    /**
     * @return TrafficHandler
     */
    public function traffic()
    {
        if (!$this->trafficHandler) {
            $this->trafficHandler = new TrafficHandler($this);
        }

        return $this->trafficHandler;
    }

    private $alertHandler;

    /**
     * @return DdosAlertHandler
     */
    public function ddos_alerts()
    {
        if (!$this->alertHandler) {
            $this->alertHandler = new DdosAlertHandler($this);
        }

        return $this->alertHandler;
    }

    private $accountingHandler;

    /**
     * @return AccountingHandler
     */
    public function accounting()
    {
        if (!$this->accountingHandler) {
            $this->accountingHandler = new AccountingHandler($this);
        }

        return $this->accountingHandler;
    }

    private $certificateHandler;

    /**
     * @return CertificateHandler
     */
    public function ssl_certificates()
    {
        if (!$this->certificateHandler) {
            $this->certificateHandler = new CertificateHandler($this);
        }

        return $this->certificateHandler;
    }

    private $addressesHandler;

    /**
     * @return AddressesHandler
     */
    public function addresses()
    {
        if (!$this->addressesHandler) {
            $this->addressesHandler = new AddressesHandler($this);
        }

        return $this->addressesHandler;
    }

    private $pxeInstallationHandler;

    /**
     * @return PxeInstallationHandler
     */
    public function pxe_installations()
    {
        if (!$this->pxeInstallationHandler) {
            $this->pxeInstallationHandler = new PxeInstallationHandler($this);
        }

        return $this->pxeInstallationHandler;
    }
}
