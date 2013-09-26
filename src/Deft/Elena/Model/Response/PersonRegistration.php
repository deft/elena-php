<?php

namespace Deft\Elena\Model\Response;

class PersonRegistration extends Registration
{
    /** @var string */
    protected $initials;
    public function getInitials() { return $this->initials; }

    /** @var string */
    protected $lastNamePrefix;
    public function getLastNamePrefix() { return $this->lastNamePrefix; }

    /** @var string */
    protected $lastName;
    public function getLastName() { return $this->lastName; }

    /** @var \DateTime */
    protected $dateOfBirth;
    public function getDateOfBirth() { return $this->dateOfBirth; }

    public function __construct(array $input)
    {
        parent::__construct($input);

        $this->initials         = @$input['initials'];
        $this->lastNamePrefix   = @$input['lastNamePrefix'];
        $this->lastName         = @$input['lastName'];
        $this->dateOfBirth      = @$input['dateOfBirth'] ? new \DateTime($input['dateOfBirth']) : null;
    }

    protected static function getTranslations()
    {
        return array_merge(parent::getTranslations(), [
            'Initialen'     => 'initials'       ,
            'Voorvoegsels'  => 'lastNamePrefix' ,
            'Achternaam'    => 'lastName'       ,
            'Geboortedatum' => 'dateOfBirth'    ,
        ]);
    }
}
