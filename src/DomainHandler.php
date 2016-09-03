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

    public function __construct(LUMASERV $lumaserv)
    {
        $this->lumaserv = $lumaserv;
    }


    /**
     * @return array|string
     */
    public function getAll() {
        return $this->lumaserv->get('domains');
    }

    /**
     * search for special domains / a special domains
     * you can pass filter_domain and filter_username or only one of this fields
     * if you leave both fields empty, you will get all domains
     *
     * @param string $filter_domain     basic sql search parameters like %, _ etc. are possible
     * @param string $filter_username   basic sql search parameters like %, _ etc. are possible
     * @return array|string
     */
    public function searchDomain($filter_domain = '', $filter_username = '') {
        return $this->lumaserv->get('domains', [
            'filter_domain' => $filter_domain,
            'filter_username' => $filter_username
        ]);
    }

    /**
     * check the availability of a domain
     *
     * @param $sld
     * @param $tld
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
     * otherwise you will get the prices in the default format of your account
     *
     * @param $ust_inkl bool|null   use null for default settings, true to get prices inklusive ust and false to get price without ust
     * @return array|string
     */
    public function getPrices($ust_inkl = null) {
        $settings = [];
        if ($ust_inkl !== null) {
            $settings['ust_inkl'] = $ust_inkl;
        }
        return $this->lumaserv->get('domains/prices', $settings);
    }
}
