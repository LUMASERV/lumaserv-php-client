<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 02.09.2016
 * Time: 00:33.
 */
namespace LumaservSystems;

class AddressesHandler
{
    private $lumaserv;

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }

    /**
     * @param $address
     * @param $rdns
     * @return array|string
     */
    public function setRdns($address, $rdns)
    {
        return $this->lumaserv->post('addresses/single/rdns', [
            'ip'        => $address,
            'rdns'      => $rdns,
        ]);
    }
}
