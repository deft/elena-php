<?php

namespace Deft\Elena\Model\Response;

class PersonRegistrationDetails
{
    private $registrationId;
    public function getRegistrationId() { return $this->registrationId; }

    private $address;
    public function getAddress() { return $this->address;}

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

    public function __construct(array $input)
    {
        foreach ($input as $key => $variable) {
            if (is_object($variable)) continue;
            $key = $this->translate($key);
            $this->$key = $variable;
        }

        if (array_key_exists('DatumGestolen', $input)) { $this->dateStolen = new \DateTime($input['DatumGestolen']); }

        $this->address = new Address(get_object_vars($input['Adres']));
        $this->person = new Person(get_object_vars($input['Persoon']));
        $this->vehicle = new Vehicle(get_object_vars($input['Voertuig']));
    }

    private function getTranslation()
    {
        return [
            'RegistratieID' => 'registrationId',
            'Adres' => 'address',
            'Persoon' => 'person',
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
