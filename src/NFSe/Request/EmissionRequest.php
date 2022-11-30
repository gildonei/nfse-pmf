<?php

namespace NFSe\Request;

use NFSe\Request\AbstractRequest;
use NFSe\Entity\Issuer;
use NFSe\Entity\XmlEntity;
use NFSe\Environment;
use NFSe\Exception\NFSeRequestException;

/**
 * Class EmissionRequest
 *
 * @package NFSe\Request
 */
class EmissionRequest extends AbstractRequest
{
    /**
     * Constructor.
     *
     * @param \NFSe\Entity\Issuer $issuer
     * @param \NFSe\Environment $environment
     */
    public function __construct(Issuer $issuer, Environment $environment)
    {
        parent::__construct($issuer, $environment);
    }

    /**
     * @param mixed $param
     * @param array $headers  Extra headers
     * @return mixed
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     */
    public function execute($param = null)
    {
        if (empty($this->getEndpoint())) {
            throw new NFSeRequestException('Endpoint is empty!', 422);
        }
        $url = $this->getEnvironment()->getApiUrl() . $this->getEndpoint();
        $headers['Content-Type'] = 'Content-Type: application/xml';

        return $this->sendRequest('POST', $url, $param, $headers);
    }

    /**
     * @access protected
     * @param string $data
     * @return mixed
     */
    protected function unserialize($data)
    {
        $json = json_decode($data, true);

        return (empty($data) || empty($json)) ? $data : $json;
    }

    /**
     * Send a XML file to registration
     * @param \NFSe\Entity\XmlEntity $xml
     * @return string Xml file content
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#tag/Processamento/paths/~1processamento~1notas~1processa/post Request XML
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/exemploRetornoProcessamento.xml Response XML
     */
    public function regular(XmlEntity $xml)
    {
        $this->setEndpoint("processamento/notas/processa");

        return $this->execute($xml->generateXml());
    }

    /**
     * Send a XML file to registration
     * * @todo NÃO IMPLEMENTADO
     * @param \NFSe\Entity\XmlEntity $xml
     * @return string Xml file content
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#tag/Processamento/paths/~1processamento~1notas~1processa-simplificada/post Request XML
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/exemploRetornoProcessamentoSimplificada.xml Response XML
     */
    public function simplified(XmlEntity $xml)
    {
        // @TODO - Finish implementation
        // $this->setEndpoint("processamento/notas/processa-simplificada");

        return '';//$this->execute($xml->generateXml());
    }

    /**
     * Send a XML file to registration
     * @todo NÃO IMPLEMENTADO
     * @param \NFSe\Entity\XmlEntity $xml
     * @return string Xml file content
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#tag/Processamento/paths/~1processamento~1notas~1processa-substituta/post Request XML
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/exemploRetornoProcessamentoSubstituta.xml Response XML
     */
    public function replacement(XmlEntity $xml)
    {
        // @TODO - Finish implementation
        // $this->setEndpoint("processamento/notas/processa-substituta");

        return '';//$this->execute($xml->generateXml());
    }

    /**
     * Send a XML file to registration
     * @param \NFSe\Entity\XmlEntity $xml
     * @return string
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#tag/Processamento/paths/~1processamento~1notas~1valida-processamento/post Request XML
     */
    public function validateXml(XmlEntity $xml)
    {
        $this->setEndpoint("processamento/notas/valida-processamento");

        return $this->execute($xml->generateXml());
    }
}
