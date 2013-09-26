<?php

namespace Deft\Elena\Model\Response;

class Person
{

    public function __construct($input)
    {
        foreach ($input as $key => $value)
        {
            $key = $this->translate($key);
            $this->$key = $value;
        }

        if (array_key_exists('Geboortedatum', $input)) { $this->birthDate = new \DateTime($input['Geboortedatum']); }
        if (array_key_exists('DatumUitgifteID', $input)) { $this->dateOfIssueId = new \DateTime($input['DatumUitgifteID']); }
        if (array_key_exists('DatumUitgiftePaspoort', $input)) { $this->dateOfIssuePassport = new \DateTime($input['DatumUitgiftePaspoort']);}
        if (array_key_exists('DatumUitgifteRijbewijs', $input)) { $this->dateOfIssueDriversLicence = new \DateTime($input['DatumUitgifteRijbewijs']);}
    }

    private $initials;
    public function getInitials() { return $this->initials; }

    private $firstName;
    public function getSurname() { return $this->firstName; }

    private $prefix;
    public function getPrefix() { return $this->prefix; }

    private $lastName;
    public function getLastName() { return $this->lastName; }

    private $gender;
    public function getGender() { return $this->gender; }

    private $birthDate;
    public function getBirthDate() { return $this->birthDate; }

    private $birthplace;
    public function getBirthplace() { return $this->birthplace; }

    private $idNumber;
    public function getIdNumber() { return $this->idNumber; }

    private $dateOfIssueId;
    public function getDateOfIssueId() { return $this->dateOfIssueId; }

    private $driverLicenceNumber;
    public function getDriverLicenceNumber() { return $this->driverLicenceNumber; }

    private $dateOfIssueDriversLicence;
    public function getDateOfIssueDriversLicence() { return $this->dateOfIssueDriversLicence; }

    private $passportNumber;
    public function getPassportNumber() { return $this->passportNumber; }

    private $dateOfIssuePassport;
    public function getDateOfIssuePassport() { return $this->dateOfIssuePassport; }

    private $email;
    public function getEmail() { return $this->email; }

    private $telephoneDay;
    public function getTelephoneDay() { return $this->telephoneDay; }

    private $telephoneNight;
    public function getTelephoneNight() { return $this->telephoneNight; }

    private $telephoneMobile;
    public function getTelephoneMobile() { return $this->telephoneMobile; }

    private $telephoneExtension;
    public function getTelephoneExtension() { return $this->telephoneExtension; }

    private $function;
    public function getFunction() { return $this->function; }

    public static function getTranslations() {
        return [
            'initials' => 'Initialen',
            'firstName' => 'Voornaam',
            'prefix' => 'Voorvoegsels',
            'lastName' => 'Achternaam',
            'gender' => 'Geslacht',
            'birthDate' => 'Geboortedatum',
            'birthplace' => 'Geboorteplaats',
            'idNumber' => 'IDNummer',
            'dateOfIssueId' => 'DatumUitgifteID',
            'driverLicenceNumber' => 'Rijbewijsnummer',
            'dateOfIssueDriversLicence' => 'DatumUitgifteRijbewijs',
            'passportNumber' => 'Paspoortnummer',
            'dateOfIssuePassport' => 'DatumUitgiftePaspoort',
            'email' => 'Email',
            'telephoneDay' => 'TelefoonOverdag',
            'telephoneMobile' => 'TelefoonMobiel',
            'telephoneNight' => 'TelefoonNacht',
            'telephoneExtension' => 'TelefoonExtensie',
            'function' => 'Functie'
        ];
    }

    private function translate($word) {foreach (self::getTranslations() as $english => $dutch){ if ($word === $dutch) return $english; }}
}
