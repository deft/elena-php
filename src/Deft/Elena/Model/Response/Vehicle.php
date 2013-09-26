<?php

namespace Deft\Elena\Model\Response;

class Vehicle
{

    public function __construct($input)
    {
        foreach ($input as $key => $value)
        {
            $key = $this->translate($key);
            $this->$key = $value;
        }

        if (array_key_exists('Registratiedatum', $input)) { $this->registrationDateTime = new \DateTime($input['Registratiedatum']);}
    }

    private $brandCode;
    public function getBrandCode() { return $this->brandCode; }

    private $model;
    public function getModel() { return $this->model; }

    private $licencePlateNumber;
    public function getLicencePlateNumber() { return $this->licencePlateNumber; }

    private $chassisnumber;
    public function getChassisNumber() { return $this->chassisnumber; }

    private $registrationDateTime;
    public function getRegistrationDateTime() { return $this->registrationDateTime; }

    private $color;
    public function getColor() { return $this->color; }

    public static function getTranslations() {
        return [
            'brandCode' => 'MerkCodering',
            'model' => 'Model',
            'licencePlateNumber' => 'Kenteken',
            'chassisnumber' => 'Chassisnummer',
            'registrationDateTime' => 'Registratiedatum',
            'color' => 'Kleur'
        ];
    }

    private function translate($word) { foreach (self::getTranslations() as $english => $dutch) { if ($word === $dutch) return $english; }}
}
