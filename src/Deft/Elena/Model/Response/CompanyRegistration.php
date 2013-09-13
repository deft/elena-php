<?php

namespace Deft\Elena\Model\Response;

class CompanyRegistration extends Registration
{
    /** @var string */
    protected $memberId;
    public function getMemberId() { return $this->memberId; }

    /** @var string */
    protected $companyName;
    public function getCompanyName() { return $this->companyName; }

    /** @var string */
    protected $cocNumber;
    public function getCocNumber() { return $this->cocNumber; }

    /** @var string */
    protected $contactPerson;
    public function getContactPerson() { return $this->contactPerson; }

    public function __construct(array $input)
    {
        parent::__construct($input);

        $this->memberId         = @$input['memberId'];
        $this->companyName      = @$input['companyName'];
        $this->cocNumber        = @$input['cocNumber'];
        $this->contactPerson    = @$input['contactPerson'];
    }

    protected static function getTranslations()
    {
        return array_merge(parent::getTranslations(), [
            'Bedrijfsnaam'      => 'companyName'    ,
            'KVKNummer'         => 'cocNumber'      ,
            'Contactpersoon'    => 'contactPerson'  ,
        ]);
    }
}
