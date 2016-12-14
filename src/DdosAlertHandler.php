<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 02.09.2016
 * Time: 00:33.
 */
namespace LumaservSystems;

class DdosAlertHandler
{
    private $lumaserv;

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }

    /**
     * @param null $start
     * @param null $end
     * @return array|string
     */
    public function getAll($start = null, $end = null)
    {
        return $this->lumaserv->get('ddos-alerts', [
            'start' => $start,
            'end' => $end
        ]);
    }

    public function getFilter($addresses = [], $start = null, $end = null)
    {
        return $this->lumaserv->get('ddos-alerts', [
            'addresses' => $addresses,
            'start' => $start,
            'end' => $end
        ]);
    }
}
