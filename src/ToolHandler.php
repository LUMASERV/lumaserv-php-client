<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 02.09.2016
 * Time: 00:33.
 */
namespace LumaservSystems;

class ToolHandler
{
    private $lumaserv;

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }

    public function transferMails($src_host, $src_mail, $src_password, $src_port, $src_encryption, $tgt_host, $tgt_mail, $tgt_password, $tgt_port, $tgt_encryption)
    {
        return $this->lumaserv->post('tools/mailTransfer', [
            'src_host' => $src_host,
            'src_mail' => $src_mail,
            'src_password' => $src_password,
            'src_port' => $src_port,
            'src_encryption' => $src_encryption,
            'tgt_host' => $tgt_host,
            'tgt_mail' => $tgt_mail,
            'tgt_password' => $tgt_password,
            'tgt_port' => $tgt_port,
            'tgt_encryption' => $tgt_encryption,
        ]);
    }
}
