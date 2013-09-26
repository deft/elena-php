<?php


namespace Deft\Elena\Model\Response;


class Company
{
    public function __construct($input)
    {
        foreach ($input as $key => $value)
        {
            $key = $this->translate($key);
            $this->$key = $value;
        }
    }

    private $name;
    public function getName() { return $this->name; }

    private $CoCNumber;
    public function getCoCNumber() { return $this->CoCNumber; }

    public static function getTranslations() {
        return [
            'name' => 'Naam',
            'CoCNumber' => 'KVKNummer'
        ];
    }

    private function translate($word) {foreach (self::getTranslations() as $english => $dutch){if ($word === $dutch) return $english;}}
}
