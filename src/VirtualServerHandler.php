<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 02.09.2016
 * Time: 00:33.
 */
namespace LumaservSystems;

use LumaservSystems\VirtualServer\SingleVirtualServerHandler;

class VirtualServerHandler
{
    private $lumaserv;

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }

    /**
     * @param null $start
     * @param null $end
     * @param null $interval
     * @return array|string
     */
    public function getAll()
    {
        return $this->lumaserv->get('servers/virtual');
    }

    public function orderServer($cores, $memory, $disk, $addresses_v4, $backups, $password = null, $template = null, $hostname = null)
    {
        return $this->lumaserv->post('servers/virtual/order', [
            'cores' => $cores,
            'memory' => $memory,
            'disk' => $disk,
            'addresses_v4' => $addresses_v4,
            'backups' => $backups,
            'password' => $password,
            'template' => $template,
            'hostname' => $hostname
        ]);
    }

    public function single($id)
    {
        return new SingleVirtualServerHandler($id, $this->lumaserv);
    }
}
