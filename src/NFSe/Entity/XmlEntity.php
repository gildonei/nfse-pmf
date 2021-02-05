<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;
use NFSe\Entity\Provider;
use NFSe\Entity\Taker;
use NFSe\Entity\Service;

/**
 * Entity Xml
 *
 * @package NFSe\Entity
 */
class XmlEntity extends AbstractEntity
{
    /**
     * Provider
     * @var \NFSe\Entity\Provider
     */
    private $provider;

    /**
     * Taker
     * @var \NFSe\Entity\Taker
     */
    private $taker;

    /**
     * Service list
     * @var array   Service
     */
    private $serviceList;

    /**
     * NFSe calculation base
     * @var float   9999999999999,99
     */
    private $baseCalc;

    /**
     * NFSe replacement calculation base
     * @var float   9999999999999,99
     */
    private $baseCalcReplacement;

    /**
     * Código Fiscal de Prestação de Serviços
     * @var int
     */
    private $cfps;

    /**
     * NFSe ISSQN value
     * @var float   9999999999999,99
     */
    private $issqnValue;

    /**
     * NFSe ISSQN replacement value
     * @var float   9999999999999,99
     */
    private $issqnReplacementValue;

    /**
     * NFSe total value
     * @var float   9999999999999,99
     */
    private $totalValue;

    /**
     * NFSe identification
     * @var string
     */
    private $identification;

    /**
     * NFSe Certification signature value
     * @var string X509 Value
     * @see xmlns:ds=http://www.w3.org/2000/09/xmldsig
     */
    private $signature;

    /**
     * Set provider
     * @access public
     * @param \NFSe\Entity\Provider NFSe provider
     * @return \NFSe\Entity\XmlEntity
     */
    public function setProvider(Provider $provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Return provider
     * @access public
     * @return \NFSe\Entity\Provider
     */
    public function getProvider()
    {
        return (empty($this->provider)) ? new Provider() : $this->provider;
    }

    /**
     * Set taker
     * @access public
     * @param \NFSe\Entity\Taker NFSe taker
     * @return \NFSe\Entity\XmlEntity
     */
    public function setTaker(Taker $taker)
    {
        $this->taker = $taker;

        return $this;
    }

    /**
     * Return taker
     * @access public
     * @return \NFSe\Entity\Taker
     */
    public function getTaker()
    {
        return (empty($this->taker)) ? new Taker() : $this->taker;
    }

    /**
     * Adds a new service to service list
     * @access public
     * @param \NFSe\Entity\Service
     * @return \NFSe\Entity\XmlEntity
     */
    public function addService(Service $service)
    {
        $this->serviceList[] = $service;

        return $this;
    }

    /**
     * Return an array of Service
     * @access public
     * @return array array of \NFSe\Entity\Service
     */
    public function getServiceList()
    {
        return $this->serviceList;
    }

    /**
     * Return a new service
     * @access public
     * @return \NFSe\Entity\Service
     */
    public function getService()
    {
        return new Service();
    }

    /**
     * Define CFPS
     * @param int $number
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setCfps($cfps)
    {
        if (empty($cfps)) {
            throw new \InvalidArgumentException('CFPS is empty!');
        }
        if (!is_numeric($cfps)) {
            throw new \InvalidArgumentException('CFPS must be numeric!');
        }
        if (strlen($cfps) != 4) {
            throw new \InvalidArgumentException('CFPS must have 4 digits!');
        }
        $this->cfps = $cfps;

        return $this;
    }

    /**
     * Return CFPS
     * @return int
     */
    public function getCfps()
    {
        return $this->cfps;
    }

    /**
     * Define base calc
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setBaseCalc($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('Base Calc must be a float number!');
        }
        $this->baseCalc = $value;

        return $this;
    }

    /**
     * Returns base calc
     * @return float
     */
    public function getBaseCalc()
    {
        return $this->baseCalc;
    }

    /**
     * Define invoice iss
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setBaseCalcReplacement($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('Base Calc Replacement must be a float number!');
        }
        $this->baseCalcReplacement = $value;

        return $this;
    }

    /**
     * Returns invoice iss
     * @return float
     */
    public function getBaseCalcReplacement()
    {
        return $this->baseCalcReplacement;
    }

    /**
     * Define ISSQN
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setIssqn($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('ISSQN must be a float number!');
        }
        $this->issqnValue = $value;

        return $this;
    }

    /**
     * Returns ISSQN
     * @return float
     */
    public function getIssqn()
    {
        return $this->issqnValue;
    }

    /**
     * Define ISSQN replacement value
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setIssqnReplacement($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('ISSQN Replacement must be a float number!');
        }
        $this->issqnReplacementValue = $value;

        return $this;
    }

    /**
     * Returns ISSQN replacement value
     * @return float
     */
    public function getIssqnReplacement()
    {
        return $this->issqnReplacementValue;
    }

    /**
     * Define ISSQN replacement value
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setTotalValue($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('Total Value must be a float number!');
        }
        $this->totalValue = $value;

        return $this;
    }

    /**
     * Returns ISSQN replacement value
     * @return float
     */
    public function getTotalValue()
    {
        return $this->totalValue;
    }

    /**
     * Define identification
     * @param string $identification
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setIdentification($identification)
    {
        if (empty($identification)) {
            throw new \InvalidArgumentException('Identifcation is empty!');
        }
        $this->identification = $identification;

        return $this;
    }

    /**
     * Return identification
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Define Signature
     * @param string $signature
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setSignature($signature)
    {
        if (empty($signature)) {
            throw new \InvalidArgumentException('Signature is empty!');
        }
        $this->signature = $signature;

        return $this;
    }

    /**
     * Return username
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Generate XML of invoice to be sent
     * @access public
     * @param string $filename  filename.xml, including absolut path where file should be saved
     * @throws \InvalidArgumentException
     * @return string|void   Returns xml file if savePath is not set
     */
    public function generateXml($filename = null)
    {
        $signature = null;

        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        // Create main nodes
        $xmlNfse = $xml->createElement('xmlProcessamentoNfpse');
        $xmlServiceList = $xml->createElement('itensServico');
        $xmlSignature = $xml->createElementNS('http://www.w3.org/2000/09/xmldsig', 'ds:Signature', $signature);

        // Append service nodes
        foreach ($this->getServiceList() as $service)
        {
            $xmlService = $xml->createElement('itemServico');
            $xmlService->appendChild($xml->createElement('aliquota', $service->getRateValue()));
            $xmlService->appendChild($xml->createElement('baseCalculo', $service->getBaseCalc()));
            $xmlService->appendChild($xml->createElement('cst', $service->getCst()));
            $xmlService->appendChild($xml->createElement('idCNAE', $service->getIdCnae()));
            $xmlService->appendChild($xml->createElement('descricaoServico', $service->getDescription()));
            $xmlService->appendChild($xml->createElement('quantidade', $service->getAmount()));
            $xmlService->appendChild($xml->createElement('valorUnitario', $service->getUnitValue()));
            $xmlService->appendChild($xml->createElement('valorTotal', $service->getTotalValue()));

            $xmlServiceList->appendChild($xmlService);
        }

        // Append all extra nodes
        $xmlNfse->appendChild($xml->createElement('dataEmissao', date('Y-m-d')));
        $xmlNfse->appendChild($xml->createElement('razaoSocialTomador', $this->getTaker()->getCompanyName()));
        $xmlNfse->appendChild($xml->createElement('identificacaoTomador', $this->getTaker()->getDocument()));
        $xmlNfse->appendChild($xml->createElement('inscricaoMunicipalTomador', $this->getTaker()->getCmc()));
        $xmlNfse->appendChild($xml->createElement('codigoPostalTomador', $this->getTaker()->getAddress()->getZipcode()));
        $xmlNfse->appendChild($xml->createElement('logradouroTomador', $this->getTaker()->getAddress()->getStreet()));
        $xmlNfse->appendChild($xml->createElement('numeroEnderecoTomador', $this->getTaker()->getAddress()->getStreetNumber()));
        $xmlNfse->appendChild($xml->createElement('complementoEnderecoTomador', $this->getTaker()->getAddress()->getComplement()));
        $xmlNfse->appendChild($xml->createElement('bairroTomador', $this->getTaker()->getAddress()->getDistrict()));
        $xmlNfse->appendChild($xml->createElement('codigoMunicipioTomador', $this->getTaker()->getAddress()->getCityCode()));
        $xmlNfse->appendChild($xml->createElement('nomeMunicipioTomador', $this->getTaker()->getAddress()->getCity()));
        $xmlNfse->appendChild($xml->createElement('ufTomador', $this->getTaker()->getAddress()->getState()));
        $xmlNfse->appendChild($xml->createElement('paisTomador', '1058'));
        $xmlNfse->appendChild($xml->createElement('dadosAdicionais', $this->getTaker()->getAdditionalData()));
        $xmlNfse->appendChild($xml->createElement('telefoneTomador', $this->getTaker()->getPhone()->getPhone()));
        $xmlNfse->appendChild($xml->createElement('emailTomador', $this->getTaker()->getEmail()));
        $xmlNfse->appendChild($xml->createElement('numeroAEDF', $this->getProvider()->getAedf()));
        $xmlNfse->appendChild($xml->createElement('identificacao', $this->getIdentification()));
        $xmlNfse->appendChild($xmlServiceList);
        $xmlNfse->appendChild($xml->createElement('baseCalculo', $this->getBaseCalc()));
        $xmlNfse->appendChild($xml->createElement('baseCalculoSubstituicao', $this->getBaseCalcReplacement()));
        $xmlNfse->appendChild($xml->createElement('valorISSQN', $this->getIssqn()));
        $xmlNfse->appendChild($xml->createElement('valorISSQNSubstituicao', $this->getIssqnReplacement()));
        $xmlNfse->appendChild($xml->createElement('valorTotalServicos', $this->getTotalValue()));
        $xmlNfse->appendChild($xml->createElement('cfps', $this->getCfps()));
        $xmlNfse->appendChild($xmlSignature);

        $xml->appendChild($xmlNfse);

        if (empty($filename)) {
            return $xml->saveXML();
        } else {
            $path = pathinfo($filename);
            if (strtolower($path['extension']) !== 'xml') {
                throw new \InvalidArgumentException('Filename does\'t have .XML extension!');
            }
            if (!file_exists($path['dirname'])) {
                throw new \InvalidArgumentException('Save path does not exists!');
            }
            if (!is_writable($path['dirname'])) {
                throw new \InvalidArgumentException('Save path is not writeable!');
            }
            $xml->save($filename);

            return true;
        }
    }

    /**
     * @todo
     */
    public function validateXml()
    {
        // @TODO
    }
}
