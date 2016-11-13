<?php
/**
 * Created by PhpStorm.
 * User: jpwal
 * Date: 27.09.2016
 * Time: 23:28.
 */
namespace LumaservSystems;

class DomainHandleHandler
{
    private $domainhandler;
    private $lumaserv;

    public function __construct(DomainHandler $domainhandler, LUMASERV $lumaserv)
    {
        $this->domainhandler = $domainhandler;
        $this->lumaserv = $lumaserv;
    }

    /**
     * @return array|string
     */
    public function getAll()
    {
        return $this->lumaserv->get('domains/handles');
    }

    public function searchHandle($filter_handle = '', $filter_firstname = '', $filter_lastname = '', $filter_organisation = '', $filter_username = '')
    {
        return $this->lumaserv->get('domains/handles', [
            'filter_handle'          => $filter_handle,
            'filter_firstname'       => $filter_firstname,
            'filter_lastname'        => $filter_lastname,
            'filter_organisation'    => $filter_organisation,
            'filter_username'        => $filter_username,
        ]);
    }

    public function create($type, $sex, $firstname, $lastname, $organisation, $street, $number, $postcode, $city, $region, $country, $phone, $fax, $email, $countryofbirth,
                           $idcard = null, $idcardauthority = null, $idcardissuedate = null, $taxnr = null, $vatnr = null, $dateofbirth = null, $placeofbirth = null,
                           $regionofbirth = null, $registrationnumber = null)
    {
        return $this->lumaserv->post('domains/handles/create', [
            'type'               => $type,
            'sex'                => $sex,
            'firstname'          => $firstname,
            'lastname'           => $lastname,
            'organisation'       => $organisation != '' ? $organisation : null,
            'street'             => $street,
            'number'             => $number,
            'postcode'           => $postcode,
            'city'               => $city,
            'region'             => $region,
            'country'            => $country,
            'phone'              => $phone,
            'fax'                => $fax != '' ? $fax : null,
            'email'              => $email,
            'countryofbirth'     => $countryofbirth,
            'idcard'             => $idcard,
            'idcardauthority'    => $idcardauthority,
            'idcardissuedate'    => $idcardissuedate,
            'taxnr'              => $taxnr,
            'vatnr'              => $vatnr,
            'dateofbirth'        => $dateofbirth,
            'placeofbirth'       => $placeofbirth,
            'regionofbirth'      => $regionofbirth,
            'registrationnumber' => $registrationnumber,
        ]);
    }

    public function update($handle, $organisation, $street, $number, $postcode, $city, $region, $country, $phone, $fax, $email, $countryofbirth,
                           $idcard = null, $idcardauthority = null, $idcardissuedate = null, $taxnr = null, $vatnr = null, $dateofbirth = null, $placeofbirth = null,
                           $regionofbirth = null, $registrationnumber = null)
    {
        return $this->lumaserv->put('domains/handles/update', [
            'handle'             => $handle,
            'organisation'       => $organisation != '' ? $organisation : null,
            'street'             => $street,
            'number'             => $number,
            'postcode'           => $postcode,
            'city'               => $city,
            'region'             => $region,
            'country'            => $country,
            'phone'              => $phone,
            'fax'                => $fax != '' ? $fax : null,
            'email'              => $email,
            'countryofbirth'     => $countryofbirth,
            'idcard'             => $idcard,
            'idcardauthority'    => $idcardauthority,
            'idcardissuedate'    => $idcardissuedate,
            'taxnr'              => $taxnr,
            'vatnr'              => $vatnr,
            'dateofbirth'        => $dateofbirth,
            'placeofbirth'       => $placeofbirth,
            'regionofbirth'      => $regionofbirth,
            'registrationnumber' => $registrationnumber,
        ]);
    }
}
