<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;
use NFSe\Entity\Provider;
use NFSe\Entity\Taker;
use NFSe\Entity\Service;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;


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
     * Array containing ceritifica files obtained with openssl_pkcs12_read
     * [
     *  'cert' => ''
     *  'pkey' => ''
     * ]
     * @var array
     */
    private $certificates;

    /**
     * PKCS12 file path
     * @var string ./path/certificate/file.pfx
     */
    private $certificatePath;

    /**
     * PKCS12 passphrase
     * @var string
     */
    private $passphrase;

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
     * Define PFX certificate path and parses it into an array
     * @param string $path
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     * @see https://www.php.net/manual/pt_BR/function.openssl-pkcs12-read
     */
    public function setCertificatePath($path = null)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException('Certificate file not found in path!');
        }
        $this->certificatePath = $path;

        return $this;
    }

    /**
     * Return username
     * @return string
     */
    public function getCertificatePath()
    {
        return $this->certificatePath;
    }

    /**
     * Return certificates
     * @return array
     * [
     *      'cert' => 'public certificate'
     *      'pkey' => 'private certificate key'
     * ]
     */
    public function getCertificates()
    {
        (empty($this->certificates)) ?
            openssl_pkcs12_read(file_get_contents($this->getCertificatePath()), $this->certificates, $this->getPassphrase()) :
            $this->certificates;

        return $this->certificates;
    }

    /**
     * Define PFX certificate private key passphrase
     * @param string $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\XmlEntity
     */
    public function setPassphrase($value = null)
    {
        $this->passphrase = $value;

        return $this;
    }

    /**
     * Return username
     * @return string
     */
    public function getPassphrase()
    {
        return $this->passphrase;
    }

    /**
     * Generate and Sign XML of invoice to be sent
     * @access public
     * @param string $filename  filename.xml, including absolut path where file should be saved
     * @param string $pfx  pfx certificate file
     * @param string $passphrase  private key passphrase if has a key
     * @throws \InvalidArgumentException
     * @return string|void   Returns xml file if savePath is not set
     */
    public function generateXml($filename = null)
    {
        if (empty($this->getCertificatePath())) {
            throw new \InvalidArgumentException('PFX certificate path is empty!');
        }

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        // Create main nodes
        $xmlNfse = $dom->createElement('xmlProcessamentoNfpse');
        $xmlServiceList = $dom->createElement('itensServico');

        // Append service nodes
        foreach ($this->getServiceList() as $service)
        {
            $xmlService = $dom->createElement('itemServico');
            $xmlService->appendChild($dom->createElement('aliquota', $service->getRateValue()));
            $xmlService->appendChild($dom->createElement('baseCalculo', $service->getBaseCalc()));
            $xmlService->appendChild($dom->createElement('cst', $service->getCst()));
            $xmlService->appendChild($dom->createElement('idCNAE', $service->getIdCnae()));
            $xmlService->appendChild($dom->createElement('descricaoServico', $service->getDescription()));
            $xmlService->appendChild($dom->createElement('quantidade', $service->getAmount()));
            $xmlService->appendChild($dom->createElement('valorUnitario', $service->getUnitValue()));
            $xmlService->appendChild($dom->createElement('valorTotal', $service->getTotalValue()));

            $xmlServiceList->appendChild($xmlService);
        }

        // Append all extra nodes
        $xmlNfse->appendChild($dom->createElement('dataEmissao', date('Y-m-d')));
        $xmlNfse->appendChild($dom->createElement('razaoSocialTomador', $this->getTaker()->getCompanyName()));
        $xmlNfse->appendChild($dom->createElement('identificacaoTomador', $this->getTaker()->getDocument()));
        if (!empty($this->getTaker()->getCmc())) {
            $xmlNfse->appendChild($dom->createElement('inscricaoMunicipalTomador', $this->getTaker()->getCmc()));
        }
        $xmlNfse->appendChild($dom->createElement('codigoPostalTomador', $this->getTaker()->getAddress()->getZipcode()));
        $xmlNfse->appendChild($dom->createElement('logradouroTomador', $this->getTaker()->getAddress()->getStreet()));
        $xmlNfse->appendChild($dom->createElement('numeroEnderecoTomador', $this->getTaker()->getAddress()->getStreetNumber()));
        $xmlNfse->appendChild($dom->createElement('complementoEnderecoTomador', $this->getTaker()->getAddress()->getComplement()));
        $xmlNfse->appendChild($dom->createElement('bairroTomador', $this->getTaker()->getAddress()->getDistrict()));
        $xmlNfse->appendChild($dom->createElement('codigoMunicipioTomador', $this->getTaker()->getAddress()->getCityCode()));
        $xmlNfse->appendChild($dom->createElement('nomeMunicipioTomador', $this->getTaker()->getAddress()->getCity()));
        $xmlNfse->appendChild($dom->createElement('ufTomador', $this->getTaker()->getAddress()->getState()));
        $xmlNfse->appendChild($dom->createElement('paisTomador', '1058'));
        $xmlNfse->appendChild($dom->createElement('dadosAdicionais', $this->getTaker()->getAdditionalData()));
        $xmlNfse->appendChild($dom->createElement('telefoneTomador', $this->getTaker()->getPhone()->getPhone()));
        $xmlNfse->appendChild($dom->createElement('emailTomador', $this->getTaker()->getEmail()));
        $xmlNfse->appendChild($dom->createElement('numeroAEDF', $this->getProvider()->getAedf()));
        $xmlNfse->appendChild($dom->createElement('identificacao', $this->getIdentification()));
        $xmlNfse->appendChild($xmlServiceList);
        $xmlNfse->appendChild($dom->createElement('baseCalculo', $this->getBaseCalc()));
        $xmlNfse->appendChild($dom->createElement('baseCalculoSubstituicao', $this->getBaseCalcReplacement()));
        $xmlNfse->appendChild($dom->createElement('valorISSQN', $this->getIssqn()));
        $xmlNfse->appendChild($dom->createElement('valorISSQNSubstituicao', $this->getIssqnReplacement()));
        $xmlNfse->appendChild($dom->createElement('valorTotalServicos', $this->getTotalValue()));
        $xmlNfse->appendChild($dom->createElement('cfps', $this->getCfps()));

        // Read PFX (PKCS12) file
        $cert = $this->getCertificates();

        // Create a new Security object
        $objDSig = new XMLSecurityDSig();

        // Use the c14n exclusive canonicalization
        $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);

        // Sign using SHA-256
        $objDSig->addReference(
            $dom,
            XMLSecurityDSig::SHA256,
            ['http://www.w3.org/2000/09/xmldsig#enveloped-signature']
        );

        // Create a new (private) Security key
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, ['type'=>'private']);

        // If key has a passphrase, set it using
        if (!empty($this->getPassphrase())) {
            $objKey->passphrase = $this->getPassphrase();
        }

        // Load the private key
        $objKey->loadKey($cert['pkey']);

        // Sign the XML file
        $objDSig->sign($objKey);

        // Add the associated public key to the signature
        $objDSig->add509Cert($cert['cert']);

        // Append the signature to the XML
        $objDSig->appendSignature($xmlNfse);

        $dom->appendChild($xmlNfse);

        if (empty($filename)) {
            return $dom->saveXML();
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
            $dom->save($filename);

            return true;
        }
    }
}
