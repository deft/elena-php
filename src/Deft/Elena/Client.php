<?php

namespace Deft\Elena;

use Deft\Elena\Exception\ClientException;
use Deft\Elena\Model\Request\RegistrationQuery;
use Deft\Elena\Model\Response\PersonRegistration;
use Deft\Elena\Model\Response\RegistrationList;

/**
 * Main entry point for working with the Elena API.
 */
class Client
{
    const SECURITY_HEADER = <<<XML
<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
    <wsse:UsernameToken>
        <wsse:Username>%s</wsse:Username>
        <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">%s</wsse:Password>
    </wsse:UsernameToken>
</wsse:Security>
XML;

    /** @var \SoapClient */
    private $soapClient;

    /** @var \SoapHeader */
    private $securityHeader;

    /**
     * @param \SoapClient $soapClient
     * @param string      $username
     * @param string      $password
     */
    public function __construct(\SoapClient $soapClient, $username, $password)
    {
        $this->soapClient = $soapClient;
        $this->securityHeader = $this->buildSecurityHeader($username, $password);
    }

    /**
     * Searches the Elena API for registrations for the given query.
     *
     * @param RegistrationQuery $registrationQuery
     * @return RegistrationList
     * @throws ClientException
     */
    public function queryRegistrations(RegistrationQuery $registrationQuery)
    {
        $input = $registrationQuery->createInputArgument();

        return RegistrationList::createFromSource($this->soapCall('opvragenRegistraties', $input));
    }

    private function soapCall($function, $input)
    {
        $result = $this->soapClient->__soapCall($function, [$input], null, $this->securityHeader);

        if (!@$result->Resultaat->Succesvol) {
            throw new ClientException(@$result->Resultaat->Omschrijving ?: 'An unknown error occurred');
        }

        return $result;
    }

    /**
     * As the Elena API uses WSS for security, the Security header has to be added.
     *
     * @param string $username
     * @param string $password
     * @return \SoapHeader
     */
    private function buildSecurityHeader($username, $password)
    {
        $soapVar = new \SoapVar(sprintf(self::SECURITY_HEADER, $username, $password), XSD_ANYXML);

        return new \SoapHeader(
            "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd",
            "Security", $soapVar, true
        );
    }
}
