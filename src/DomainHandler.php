<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 02.09.2016
 * Time: 00:33.
 */
namespace LumaservSystems;

class DomainHandler
{
    private $lumaserv;
    private $zoneHandler;
    private $handleHandler;
    private $nameserverHandler;

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }

    /**
     * @return array|string
     */
    public function getAll()
    {
        return $this->lumaserv->get('domains');
    }

    /**
     * search for special domains / a special domains
     * you can pass filter_domain and filter_username or only one of this fields
     * if you leave both fields empty, you will get all domains.
     *
     * @param string $filter_domain   basic sql search parameters like %, _ etc. are possible
     * @param string $filter_username basic sql search parameters like %, _ etc. are possible
     *
     * @return array|string
     */
    public function searchDomain($filter_domain = '', $filter_username = '')
    {
        return $this->lumaserv->get('domains', [
            'filter_domain'   => $filter_domain,
            'filter_username' => $filter_username,
        ]);
    }

    /**
     * check the availability of a domain.
     *
     * @param $sld
     * @param $tld
     *
     * @return array|string
     */
    public function isAvailable($sld, $tld)
    {
        return $this->lumaserv->get('domains/check', [
            'sld' => $sld,
            'tld' => $tld,
        ]);
    }

    /**
     * get the domain pricelist which you can see in the panel
     * pass ust_inkl = true or false to get the prices inklusive or exklusive USt explicitly
     * otherwise you will get the prices in the default format of your account.
     *
     * @param $ust_inkl bool|null   use null for default settings, true to get prices inklusive ust and false to get price without ust
     *
     * @return array|string
     */
    public function getPrices($ust_inkl = null)
    {
        $settings = [];
        if ($ust_inkl !== null) {
            $settings['ust_inkl'] = $ust_inkl;
        }

        return $this->lumaserv->get('domains/prices', $settings);
    }

    /**
     * @return NameserveZoneHandler
     */
    public function zones()
    {
        if (!$this->zoneHandler) {
            $this->zoneHandler = new NameserveZoneHandler($this, $this->lumaserv);
        }

        return $this->zoneHandler;
    }

    /**
     * @return DomainHandleHandler
     */
    public function handles()
    {
        if (!$this->handleHandler) {
            $this->handleHandler = new DomainHandleHandler($this, $this->lumaserv);
        }

        return $this->handleHandler;
    }

    /**
     * @return DomainNameserverHandler
     */
    public function nameservers()
    {
        if (!$this->nameserverHandler) {
            $this->nameserverHandler = new DomainNameserverHandler($this, $this->lumaserv);
        }

        return $this->nameserverHandler;
    }

    /**
     * @param $date string      pass now for instant deletion or a date
     *
     * @return array
     */
    public function delete($sld, $tld, $date)
    {
        return $this->lumaserv->delete('domains/delete', [
            'sld'         => $sld,
            'tld'         => $tld,
            'delete_time' => $date,
        ]);
    }

    /**
     * @param $date string      pass now for instant deletion or a date
     *
     * @return array
     */
    public function undelete($sld, $tld)
    {
        return $this->lumaserv->delete('domains/delete', [
            'sld'         => $sld,
            'tld'         => $tld,
            'delete_time' => 'undelete',
        ]);
    }

    public function update($sld, $tld, $owner, $admin, $tech, $zone, $ns_1, $ns_2, $zone_id, $ns_3 = null, $ns_4 = null, $ns_5 = null)
    {
        return $this->lumaserv->put('domains/update', [
            'sld'      => $sld,
            'tld'      => $tld,
            'ownerHdl' => $owner,
            'adminHdl' => $admin,
            'techHdl'  => $tech,
            'zoneHdl'  => $zone,
            'ns1'      => $ns_1,
            'ns2'      => $ns_2,
            'ns3'      => $ns_3,
            'ns4'      => $ns_4,
            'ns5'      => $ns_5,
            'zone_id'  => $zone_id,
        ]);
    }

    public function create($sld, $tld, $owner, $admin, $tech, $zone, $ns_1, $ns_2, $ns_3 = null, $ns_4 = null, $ns_5 = null)
    {
        return $this->lumaserv->post('domains/create', [
            'sld'      => $sld,
            'tld'      => $tld,
            'ownerHdl' => $owner,
            'adminHdl' => $admin,
            'techHdl'  => $tech,
            'zoneHdl'  => $zone,
            'ns1'      => $ns_1,
            'ns2'      => $ns_2,
            'ns3'      => $ns_3,
            'ns4'      => $ns_4,
            'ns5'      => $ns_5,
        ]);
    }

    public function tranfer($sld, $tld, $authcode, $owner, $admin, $tech, $zone, $ns_1, $ns_2, $ns_3 = null, $ns_4 = null, $ns_5 = null)
    {
        return $this->lumaserv->post('domains/create', [
            'sld'      => $sld,
            'tld'      => $tld,
            'authcode' => $authcode,
            'ownerHdl' => $owner,
            'adminHdl' => $admin,
            'techHdl'  => $tech,
            'zoneHdl'  => $zone,
            'ns1'      => $ns_1,
            'ns2'      => $ns_2,
            'ns3'      => $ns_3,
            'ns4'      => $ns_4,
            'ns5'      => $ns_5,
        ]);
    }
}
