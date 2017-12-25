<?php

namespace LumaservSystems;

class PxeInstallationHandler
{
    private $lumaserv;

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }

    /**
     * @param array $addresses
     * @param null $username
     * @return array|string
     * @internal param null $start
     * @internal param null $end
     * @internal param null $interval
     */
    public function getAll($addresses = [], $username = null)
    {
        return $this->lumaserv->get('datacenter/pxe_installations', [
            'addresses' => $addresses,
            'username' => $username
        ]);
    }

    /**
     * @param $address
     * @param $mac_address
     * @param $hostname
     * @param string $template      currently DEBIAN_8 and DEBIAN_9 is supported
     * @param $password
     * @param bool $support_ssh_key
     * @param null $raid_level
     * @param null $raid_disk_count
     * @return array|string
     * @internal param $installation_id
     * @internal param array $addresses
     * @internal param null $start
     * @internal param null $end
     * @internal param null $interval
     */
    public function create($address, $mac_address, $hostname, $template, $password, $support_ssh_key = false, $raid_level = null, $raid_disk_count = null, $network_name = null, $commands = [])
    {
        return $this->lumaserv->post('datacenter/pxe_installations/create', [
            'address' => $address,
            'mac_address' => $mac_address,
            'hostname' => $hostname,
            'template' => $template,
            'password' => $password,
            'support_ssh_key' => $support_ssh_key,
            'raid_level' => $raid_level,
            'raid_disk_count' => $raid_disk_count,
            'network_name' => $network_name,
            'commands' => $commands
        ]);
    }

    /**
     * @param $installation_id
     * @return array|string
     * @internal param array $addresses
     * @internal param null $start
     * @internal param null $end
     * @internal param null $interval
     */
    public function getDetail($installation_id)
    {
        return $this->lumaserv->get('datacenter/pxe_installations/'.$installation_id);
    }

    /**
     * @param $installation_id
     * @return array|string
     * @internal param array $addresses
     * @internal param null $start
     * @internal param null $end
     * @internal param null $interval
     */
    public function cancelInstallation($installation_id)
    {
        return $this->lumaserv->post('datacenter/pxe_installations/'.$installation_id.'/cancel');
    }
}
