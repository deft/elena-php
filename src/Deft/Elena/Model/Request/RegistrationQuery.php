<?php

namespace Deft\Elena\Model\Request;

class RegistrationQuery
{
    /** @var string */
    public $name;

    /** @var string */
    public $cocNumber;

    /** @var \DateTime */
    public $dateOfBirth;

    /** @var string */
    public $houseNumber;

    /** @var string */
    public $passportNumber;

    /** @var string */
    public $zipCode;

    /** @var string */
    public $city;

    /** @var string */
    public $driversLicenseNumber;

    /** @var string */
    public $identificationCardNumber;

    public static function getTranslations()
    {
        return [
            'name'                      => 'Naam',
            'cocNumber'                 => 'KVKNummer',
            'dateOfBirth'               => 'Geboortedatum',
            'houseNumber'               => 'Huisnummer',
            'passportNumber'            => 'Paspoortnummer',
            'zipCode'                   => 'Postcode',
            'city'                      => 'Woonplaats',
            'driversLicenseNumber'      => 'IDNummer',
            'identificationCardNumber'  => 'IDNummer'
        ];
    }

    public function createInputArgument()
    {
        $translations = self::getTranslations();

        $input = new \StdClass;
        foreach ($this as $key => $value)
        {
            if (!$value) continue;
            switch ($key)
            {
                case 'dateOfBirth': $value = $value->format('Y-m-d'); break;
            }

            $input->{$translations[$key]} = $value;
        }

        return $input;
    }
}
