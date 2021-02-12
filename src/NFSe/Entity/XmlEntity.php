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
    public function setSignature($signature = null)
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

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        // Create main nodes
        $xmlNfse = $dom->createElement('xmlProcessamentoNfpse');
        $xmlServiceList = $dom->createElement('itensServico');
        $canonical = $dom->createElementNS('CanonicalizationMethod', 'Algorithm', 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315');
        $signatureMethod = $dom->createElementNS('SignatureMethod', 'Algorithm', 'http://www.w3.org/2000/09/xmldsig#rsa-sha1');

        $transform1 = $dom->createElementNS('Transform', 'Algorithm', 'http://www.w3.org/2000/09/xmldsig#enveloped-signature');
        $transform2 = $dom->createElementNS('Transform', 'Algorithm', 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315');
        $digestMethod = $dom->createElementNS('DigestMethod', 'Algorithm', 'http://www.w3.org/2000/09/xmldsig#sha1');
        $digestValue = $dom->createElement('DigestValue', '2NEHH1mLATUyAxChwQTfCUgKrpY=');

        $transforms = $dom->createElement('Transforms');
        $transforms->appendChild($transform1);
        $transforms->appendChild($transform2);

        $ref = $dom->createElement('Reference');
        $ref->setAttribute('URI', '');
        $ref->appendChild($transforms);
        $ref->appendChild($digestMethod);
        $ref->appendChild($digestValue);

        $signedInfo = $dom->createElement('SignedInfo');
        $signedInfo->appendChild($canonical);
        $signedInfo->appendChild($signatureMethod);
        $signedInfo->appendChild($ref);

        $signatureValue = $dom->createElement('SignatureValue', 'nR0MlLL2WBZvGBaxvYSyLIq8tvodWmrIEI2MBYb4ZFN/vLMqVTYH/H+/tvBOI4SKcN1++wE+QVdT oI61y2VjfGyzw1KrbdIcIgzeEi+BIQRKuswx+Ko+Xx5eFKPmK8GvDAwIRMO7Qy1U0rLVla/8kMch 9Z1DrvBRIi2dnDXiWIHdBzY2qgHOM4Shx9HCL9Z/nvr9p22nmQm/sJtQ9uGWDC6gyF4Z+I7MrrnV FOJUYe4ICEAbviphd0hmIFbkjgkSc/cHo2Akxjjv7f8fnwxk9KmIoaNIfNCFFf+WNpAglIAnSIUX g6q3LaIekNgGmrhYLuH+3n+zx09/4CV9/tGATA==');

        $x509Certificate = $dom->createElement('X509Certificate', 'MIIHkDCCBXigAwIBAgIEANGrAzANBgkqhkiG9w0BAQsFADCBiTELMAkGA1UEBhMCQlIxEzARBgNV BAoTCklDUC1CcmFzaWwxNjA0BgNVBAsTLVNlY3JldGFyaWEgZGEgUmVjZWl0YSBGZWRlcmFsIGRv IEJyYXNpbCAtIFJGQjEtMCsGA1UEAxMkQXV0b3JpZGFkZSBDZXJ0aWZpY2Fkb3JhIFNFUlBST1JG QnY0MB4XDTE2MTEwODEyMzAzN1oXDTE3MTEwODEyMzAzN1owgeYxCzAJBgNVBAYTAkJSMQswCQYD VQQIEwJTQzEWMBQGA1UEBxMNRkxPUklBTk9QT0xJUzETMBEGA1UEChMKSUNQLUJyYXNpbDE2MDQG A1UECxMtU2VjcmV0YXJpYSBkYSBSZWNlaXRhIEZlZGVyYWwgZG8gQnJhc2lsIC0gUkZCMREwDwYD VQQLEwhBUlNFUlBSTzEWMBQGA1UECxMNUkZCIGUtQ05QSiBBMTE6MDgGA1UEAxMxQlJBTUUgQVVU T01BQ0FPIEUgU0lTVEVNQVMgTFREQSBNRTowMzI4ODM3OTAwMDE3NTCCASIwDQYJKoZIhvcNAQEB BQADggEPADCCAQoCggEBAKvo98PEosyVq7PN/wbLO4UP/TKWetu9NAMiGAHu6erJil31/+1tS0nj XOWJtvDMoKgZ/vqJqPjLqSBRSbyTQetTtLbK8tIZqH0QroGIO9UY4AcSArM6Q+I7vouhSAalkBX7 NkNq2efbQKkN6NzNP3O5nC0r15X95z2PcM4IayKX41o+uSpF47xVbR1kliCAFPs7yKz2a9LqwAAB FQ0b6/mmdE7rhqhphGl0r9LDsssLl6dtjjx32jjVjXsGllUSVahhYT+xBaCVHgn7d7eOgfLXOk3n yBfh2ziQTifyPBunvGgX2bcg0WD2W20MPDO9I3EBzMQGK1V4cjJzVoEoZNcCAwEAAaOCAp8wggKb MB8GA1UdIwQYMBaAFDAKLAy4Nyvg9toC/oCCZ5aYVBk7MFsGA1UdIARUMFIwUAYGYEwBAgEKMEYw RAYIKwYBBQUHAgEWOGh0dHA6Ly9yZXBvc2l0b3Jpby5zZXJwcm8uZ292LmJyL2RvY3MvZHBjYWNz ZXJwcm9yZmIucGRmMIHRBgNVHR8EgckwgcYwPKA6oDiGNmh0dHA6Ly9yZXBvc2l0b3Jpby5zZXJw cm8uZ292LmJyL2xjci9hY3NlcnByb3JmYnY0LmNybDA+oDygOoY4aHR0cDovL2NlcnRpZmljYWRv czIuc2VycHJvLmdvdi5ici9sY3IvYWNzZXJwcm9yZmJ2NC5jcmwwRqBEoEKGQGh0dHA6Ly9yZXBv c2l0b3Jpby5pY3BicmFzaWwuZ292LmJyL2xjci9zZXJwcm8vYWNzZXJwcm9yZmJ2NC5jcmwwVgYI KwYBBQUHAQEESjBIMEYGCCsGAQUFBzAChjpodHRwOi8vcmVwb3NpdG9yaW8uc2VycHJvLmdvdi5i ci9jYWRlaWFzL2Fjc2VycHJvcmZidjQucDdiMIG/BgNVHREEgbcwgbSgOAYFYEwBAwSgLwQtMzAx MDE5Njg2NTcxMTMxOTk0OTAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwoCEGBWBMAQMCoBgEFkxV Q0lBTk8gQlJBTUUgRkVSUkVJUkGgGQYFYEwBAwOgEAQOMDMyODgzNzkwMDAxNzWgFwYFYEwBAweg DgQMMDAwMDAwMDAwMDAwgSFQUklTQ0lMQUBDT05USEFMRVNDT05UQUJJTC5DT00uQlIwDgYDVR0P AQH/BAQDAgXgMB0GA1UdJQQWMBQGCCsGAQUFBwMEBggrBgEFBQcDAjANBgkqhkiG9w0BAQsFAAOC AgEAUO9Dw1OIAqVmG3Hi+nZimrcl3j/WFJ60v44jkgDT/LWAgcSvVwRecNo13wERVjuhmQcOYsya CHEd0SU6ztpLwq0ZwyZjwgbP09YVp7nG7C+AXF3fr6oV+tj/fdgEnNNCRSes2UnNtztNq5tixyzd yZ3qukzXH8ssdlqpXCZyirepVc2xeJ167z3L+lIeJPzINWoXT/4yI1wqw6XJ8H/E4c9A8hPV59qy +JbXTWR5T7xwaE7lD365YYjtbs9NIKgue7V24quJ0uMMyiylR5K0wb0yjOre4hIlx8TgI9W68e1Q gCR6Mwyb8fFIW9B7zpxBrpJ96HAYdFnK3VYFtc6plrr+cUnafBRR6xPp/gMWHomvv8JYTt5fNy84 4I9+u6TRuah34amzjvAjKQs1Wq1i762nOg1NIud2OhNsDkYqNmSb70ZHGtxYNi+h1CTYk5jIRJYl 1A2AsoKLx+XOxFtFxPtRPegKNNrzK6Zq+GFhVuSft0nHgQEoVdwcAQA3qAtViCjOMCPI+AOocA4w b1KXKvyPUaKDhp2EXIeOWoH5pnNaG2JAdK2/FvJ/JQE+ArS6DyXVlApQzB+ugTMF+ri8oCqn8GfI UVH1qgsT40l6aNyw6nV27rOoDtLjUhzX9BSJmwXUx2EalEW6hRnrMyFhisRSm1ANoLKFipnDFTp7 dM4=');
        $x509Data = $dom->createElement('X509Data');
        $x509Data->appendChild($x509Certificate);

        $keyInfo = $dom->createElement('KeyInfo');
        $keyInfo->appendChild($x509Data);

        $xmlSignature = $dom->createElementNS('http://www.w3.org/2000/09/xmldsig', 'ds:Signature', $signature);
        $xmlSignature->appendChild($signedInfo);
        $xmlSignature->appendChild($signatureValue);
        $xmlSignature->appendChild($keyInfo);

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
        $xmlNfse->appendChild($dom->createElement('inscricaoMunicipalTomador', $this->getTaker()->getCmc()));
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
        $xmlNfse->appendChild($xmlSignature);

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
