<?php

namespace Deft\Elena\Model\Response;

class CompanyRegistrationDetails
{
    private $registrationId;
    public function getRegistrationId() { return $this->registrationId; }

    private $company;
    public function getCompany() { return $this->company; }

    private $address;
    public function getAddress() { return $this->address; }

    private $person;
    public function getPerson() { return $this->person; }

    private $vehicle;
    public function getVehicle() { return $this->vehicle; }

    private $registrationCode;
    public function getRegistrationCode() { return $this->registrationCode; }

    private $status;
    public function getStatus() { return $this->status; }

    private $description;
    public function getDescription() { return $this->description; }

    private $dateStolen;
    public function getDateStolen() { return $this->dateStolen; }

    private $documents;
    public function getDocuments() { return $this->documents; }

    public function __construct($input)
    {
        foreach ($input as $key => $variable) {
            if (is_object($variable)) { continue; }
            $key = $this->translate($key);
            $this->$key = $variable;
        }

        if (array_key_exists('DatumGestolen', $input)) { $this->dateStolen = new \DateTime($input['DatumGestolen']);}

        $this->company = new Company(get_object_vars($input['Bedrijf']));
        $this->address = new Address(get_object_vars($input['Adres']));
        $this->person = new Person(get_object_vars($input['Contactpersoon']));
        $this->vehicle = new Vehicle(get_object_vars($input['Voertuig']));
    }

    private function getTranslation()
    {
        return [
            'RegistratieID' => 'registrationId',
            'Bedrijf' => 'company',
            'Adres' => 'address',
            'Contactpersoon' => 'person',
            'Voertuig' => 'vehicle',
            'Registratiecode' => 'registrationCode',
            'Status' => 'status',
            'Toelichting' => 'description',
            'DatumGestolen' => 'dateStolen',
            'Documenten' => 'documents'
        ];
    }

    private function translate($word) { foreach ($this->getTranslation() as $dutch => $english) { if ($word === $dutch) { return $english ;}}}
}
