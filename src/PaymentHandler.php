<?php
/**
 * Created by PhpStorm.
 * User: jpwal
 * Date: 13.11.2016
 * Time: 04:25
 */

namespace LumaservSystems;


class PaymentHandler
{
    private $lumaserv;

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }

    public function create($payment_method, $amount, $mtid, $ok_url, $nok_url, $pn_url = null)
    {
        return $this->lumaserv->post('payment', [
            'payment_method'     => $payment_method,
            'transaction_amount' => $amount,
            'mtid'               => $mtid,
            'ok_url'             => $ok_url,
            'nok_url'            => $nok_url,
            'pn_url'             => $pn_url,
        ]);
    }

    public function detail($mtid)
    {
        return $this->lumaserv->get('payment', [
            'mtid' => $mtid
        ]);
    }
}