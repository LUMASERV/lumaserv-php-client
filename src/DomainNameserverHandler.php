<?php
/**
 * Created by PhpStorm.
 * User: jpwal
 * Date: 27.09.2016
 * Time: 23:28
 */

namespace LumaservSystems;


class DomainNameserverHandler
{
    private $domainhandler;
    private $lumaserv;

    public function __construct(DomainHandler $domainhandler, LUMASERV $lumaserv)
    {
        $this->domainhandler = $domainhandler;
        $this->lumaserv = $lumaserv;
    }

    /**
     * @return array|string
     */
    public function getAll()
    {
        return $this->lumaserv->get('domains/nameservers');
    }

    public function searchNameserver($filter_servername = '', $filter_ip = '', $filter_username = '')
    {
        return $this->lumaserv->get('domains/nameservers', [
            'filter_servername'     => $filter_servername,
            'filter_ip'       => $filter_ip,
            'filter_username'  => $filter_username,
        ]);
    }

    public function create($servername) {
        return $this->lumaserv->post('domains/nameservers/create', [
            'servername' => $servername
        ]);
    }

    public function refresh($servername) {
        return $this->lumaserv->get('domains/nameservers/refresh', [
            'servername' => $servername,
        ]);
    }
}