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
     * @return array|string
     */
    public function getAll()
    {
        return $this->lumaserv->get('ssl_certificates');
    }

    /**
     * search for special certificates
     * you can pass filter_name and filter_username or only one of this fields
     * if you leave both fields empty, you will get all certificates.
     *
     * @param string $filter_name   basic sql search parameters like %, _ etc. are possible
     * @param string $filter_username basic sql search parameters like %, _ etc. are possible
     *
     * @return array|string
     */
    public function searchCertificate($filter_name = '', $filter_username = '')
    {
        return $this->lumaserv->get('ssl_certificates', [
            'filter_name'   => $filter_name,
            'filter_username' => $filter_username,
        ]);
    }

    public function createWithCsr($csr, $product_key, $runtime, $approval_email,
                                  $admin_firstname, $admin_lastname, $admin_organization, $admin_region, $admin_country, $admin_phone, $admin_fax = '', $admin_email,
                                  $tech_firstname, $tech_lastname, $tech_organization, $tech_region, $tech_country, $tech_phone, $tech_fax = '', $tech_email
    )
    {
        return $this->lumaserv->post('ssl_certificates/create', [
            'type' => $product_key,
            'runtime' => $runtime,
            'own_csr' => true,
            'csr' => $csr,
            'approval_email' => $approval_email,

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

    public function createWithoutCsr($name, $csr_name, $csr_department, $csr_city, $csr_region, $csr_country, $csr_email, $product_key, $runtime, $approval_email,
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
            'approval_email' => $approval_email,

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
