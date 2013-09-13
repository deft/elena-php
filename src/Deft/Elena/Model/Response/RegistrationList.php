<?php

namespace Deft\Elena\Model\Response;

class RegistrationList
{
    /** @var CompanyRegistration[] */
    protected $companyRegistrations;
    public function getCompanyRegistrations() { return $this->companyRegistrations; }

    /** @var PersonRegistration[] */
    protected $personRegistrations;
    public function getPersonRegistrations() { return $this->personRegistrations; }

    /**
     * @param CompanyRegistration[] $companyRegistrations
     * @param PersonRegistration[]  $personRegistrations
     */
    public function __construct(array $companyRegistrations, array $personRegistrations)
    {
        $this->companyRegistrations = $companyRegistrations;
        $this->personRegistrations = $personRegistrations;
    }

    /**
     * @param \StdClass $input
     * @return RegistrationList
     */
    public static function createFromSource($input)
    {
        $prefix = implode('\\', array_slice(explode('\\', __CLASS__), 0, -1));

        $companyInput = @$input->BedrijfRegistraties->BedrijfRegistratie ?: [];
        if (is_object($companyInput)) $companyInput = [$companyInput];

        $personInput = @$input->PersoonRegistraties->PersoonRegistratie ?: [];
        if (is_object($personInput)) $personInput = [$personInput];

        return new self(
            array_map([$prefix.'\\CompanyRegistration', 'createFromSource'], $companyInput),
            array_map([$prefix.'\\PersonRegistration', 'createFromSource'], $personInput)
        );
    }
}
