<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 02.09.2016
 * Time: 00:33.
 */
namespace LumaservSystems;

class TrafficHandler
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
    public function getAll($start = null, $end = null, $interval = null)
    {
        return $this->lumaserv->get('traffic', [
            'start' => $start,
            'end' => $end,
            'interval' => $interval
        ]);
    }

    /**
     * @param array $addresses
     * @param null $start
     * @param null $end
     * @param null $interval
     * @return array|string
     */
    public function getTrafficByAddresses($addresses = [], $start = null, $end = null, $interval = null)
    {
        return $this->lumaserv->get('traffic/addresses', [
            'addresses' => $addresses,
            'start' => $start,
            'end' => $end,
            'interval' => $interval
        ]);
    }
}
