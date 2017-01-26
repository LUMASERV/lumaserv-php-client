<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 02.09.2016
 * Time: 00:33.
 */
namespace LumaservSystems;

class AccountingHandler
{
    private $lumaserv;

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }

    public function getBalance()
    {
        return $this->lumaserv->get('accounting/balance');
    }
}
