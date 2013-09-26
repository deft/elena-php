<?php

namespace Deft\Elena\Model\Response;

class Address
{

    public function __construct($input)
    {
        foreach ($input as $key => $value)
        {
            $key = $this->translate($key);
            $this->$key = $value;
        }
    }

    private $street;
    public function getStreet() { return $this->street; }

    private $housenumber;
    public function getHousenumber() { return $this->housenumber; }

    private $housenumberSuffix;
    public function getHousenumberSuffix() { return $this->housenumberSuffix; }

    private $postalCode;
    public function getPostalCode() { return $this->postalCode; }

    private $city;
    public function getCity() { return $this->city; }

    private $country;
    public function getCountry() { return $this->country; }

    public static function getTranslations() {
        return [
            'street' => 'Straatnaam',
            'housenumber' => 'Huisnummer',
            'housenumberSuffix' => 'HuisnummerToevoeging',
            'postalCode' => 'Postcode',
            'city' => 'Woonplaats',
            'country' => 'Land'
        ];
    }

    private function translate($word) { foreach (self::getTranslations() as $english => $dutch) { if ($word === $dutch) return $english; }}
}
