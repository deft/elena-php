<?php

namespace Deft\Elena\Model\Response;

abstract class Registration
{
    /** @var string */
    protected $registrationId;
    public function getRegistrationId() { return $this->registrationId; }

    /** @var string */
    protected $zipCode;
    public function getZipCode() { return $this->zipCode; }

    /** @var string */
    protected $city;
    public function getCity() { return $this->city; }

    /** @var \DateTime */
    protected $createdAt;
    public function getCreatedAt() { return $this->createdAt; }

    public function __construct($input)
    {
        $this->registrationId = @$input['registrationId'];
        $this->zipCode =        @$input['zipCode'];
        $this->city =           @$input['city'];
        $this->createdAt =      @$input['createdAt'] ? new \DateTime($input['createdAt']) : null;
    }

    public static function createFromSource($input)
    {
        $input = (array) $input;

        $translator = self::getTranslator();
        $translatedInput = array_combine(
            array_map($translator, array_keys($input)),
            array_values($input)
        );

        return new static($translatedInput);
    }

    protected static function getTranslations()
    {
        return [
            'RegistratieID' => 'registrationId' ,
            'Lidnummer'     => 'memberId'       ,
            'Postcode'      => 'zipCode'        ,
            'Woonplaats'    => 'city'           ,
            'DatumAanmaak'  => 'createdAt'      ,
        ];
    }

    protected static function getTranslator()
    {
        $translations = static::getTranslations();

        return function($key) use ($translations) {
            return isset($translations[$key]) ? $translations[$key] : $key;
        };
    }
}
