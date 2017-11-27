<?php
/**
 * Created by PhpStorm.
 * User: janwaldecker
 * Date: 05.11.17
 * Time: 19:49
 */

namespace LumaservSystems\VirtualServer;


use LumaservSystems\LUMASERV;

class SingleVirtualServerHandler
{
    private $id;
    private $lumaserv;

    public function __construct($id, LUMASERV $lumaserv)
    {
        $this->id = $id;
        $this->lumaserv = $lumaserv;
    }

    public function getDetails()
    {
        return $this->lumaserv->get('servers/virtual/'.$this->id);
    }

    public function getTasks()
    {
        return $this->lumaserv->get('servers/virtual/'.$this->id.'/tasks');
    }

    public function getBackups()
    {
        return $this->lumaserv->get('servers/virtual/'.$this->id.'/backups');
    }

    public function getAddresses()
    {
        return $this->lumaserv->get('servers/virtual/'.$this->id.'/addresses');
    }

    public function getNetworks()
    {
        return $this->lumaserv->get('servers/virtual/'.$this->id.'/networks');
    }

    public function start()
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/start');
    }

    public function shutdown()
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/shutdown');
    }

    public function stop()
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/stop');
    }

    public function restart()
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/restart');
    }

    public function createBackup($title, $mode = 'snapshot')
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/createBackup', [
            'title' => $title,
            'mode' => $mode
        ]);
    }

    public function reinstall($password, $template = 'DEBIAN_9', $support_ssh_key = false)
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/reinstall', [
            'password' => $password,
            'template' => $template,
            'support_ssh_key' => $support_ssh_key,
        ]);
    }

    public function getScheduledTasks()
    {
        return $this->lumaserv->get('servers/virtual/'.$this->id.'/scheduledTasks');
    }

    public function getNoVncConsole()
    {
        return $this->lumaserv->get('servers/virtual/'.$this->id.'/vnc');
    }

    public function restoreBackup($id)
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/backups/restore', [
            'backup_id' => $id
        ]);
    }

    public function deleteBackup($id)
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/backups/delete', [
            'backup_id' => $id
        ]);
    }

    public function reconfigure($cores, $memory, $disk, $addresses_v4, $backups)
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/reconfigure', [
            'cores' => $cores,
            'memory' => $memory,
            'disk' => $disk,
            'addresses_v4' => $addresses_v4,
            'backups' => $backups
        ]);
    }

    public function deleteServer()
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/delete');
    }

    public function createScheduledTask($action, $interval, $first_execution = null)
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/scheduledTask/create', [
            'action' => $action,
            'interval' => $interval,
            'first_execution' => $first_execution
        ]);
    }

    public function deleteScheduledTask($task_id)
    {
        return $this->lumaserv->post('servers/virtual/'.$this->id.'/scheduledTask/'.$task_id.'/delete');
    }
}