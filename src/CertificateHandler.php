<?php
/**
 * Created by PhpStorm.
 * User: Jan Waldecker
 * Date: 02.09.2016
 * Time: 00:33.
 */
namespace LumaservSystems;

class CertificateHandler
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

    public function createWithCsr($csr, $product_key, $runtime, $apporval_email,
                                  $admin_firstname, $admin_lastname, $admin_organization, $admin_region, $admin_country, $admin_phone, $admin_fax = '', $admin_email,
                                  $tech_firstname, $tech_lastname, $tech_organization, $tech_region, $tech_country, $tech_phone, $tech_fax = '', $tech_email
    )
    {
        return $this->lumaserv->post('ssl_certificates/create', [
            'type' => $product_key,
            'runtime' => $runtime,
            'own_csr' => true,
            'csr' => $csr,
            'approval_email' => $apporval_email,

            'admin_firstname' => $admin_firstname,
            'admin_lastname' => $admin_lastname,
            'admin_organization' => $admin_organization,
            'admin_region' => $admin_region,
            'admin_country' => $admin_country,
            'admin_phone' => $admin_phone,
            'admin_fax' => $admin_fax,
            'admin_email' => $admin_email,

            'tech_firstname' => $tech_firstname,
            'tech_lastname' => $tech_lastname,
            'tech_organization' => $tech_organization,
            'tech_region' => $tech_region,
            'tech_country' => $tech_country,
            'tech_phone' => $tech_phone,
            'tech_fax' => $tech_fax,
            'tech_email' => $tech_email
        ]);
    }

    public function createWithoutCsr($name, $csr_name, $csr_department, $csr_city, $csr_region, $csr_country, $csr_email, $product_key, $runtime, $apporval_email,
                                  $admin_firstname, $admin_lastname, $admin_organization, $admin_region, $admin_country, $admin_phone, $admin_fax = '', $admin_email,
                                  $tech_firstname, $tech_lastname, $tech_organization, $tech_region, $tech_country, $tech_phone, $tech_fax = '', $tech_email
    )
    {
        return $this->lumaserv->post('ssl_certificates/create', [
            'type' => $product_key,
            'runtime' => $runtime,
            'own_csr' => false,
            'name' => $name,
            'csr_name' => $csr_name,
            'csr_department' => $csr_department,
            'csr_city' => $csr_city,
            'csr_region' => $csr_region,
            'csr_country' => $csr_country,
            'csr_email' => $csr_email,
            'approval_email' => $apporval_email,

            'admin_firstname' => $admin_firstname,
            'admin_lastname' => $admin_lastname,
            'admin_organization' => $admin_organization,
            'admin_region' => $admin_region,
            'admin_country' => $admin_country,
            'admin_phone' => $admin_phone,
            'admin_fax' => $admin_fax,
            'admin_email' => $admin_email,

            'tech_firstname' => $tech_firstname,
            'tech_lastname' => $tech_lastname,
            'tech_organization' => $tech_organization,
            'tech_region' => $tech_region,
            'tech_country' => $tech_country,
            'tech_phone' => $tech_phone,
            'tech_fax' => $tech_fax,
            'tech_email' => $tech_email
        ]);
    }

    public function requestRefund($order_id)
    {
        return $this->lumaserv->post('ssl_certificates/'.$order_id.'/requestRefund');
    }

    public function getApproverList($product_key, $name)
    {
        return $this->lumaserv->get('ssl_certificates/approverList', [
            'type' => $product_key,
            'name' => $name
        ]);
    }
}
