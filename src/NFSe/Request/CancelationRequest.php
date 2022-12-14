<?php

namespace NFSe\Request;

use NFSe\Request\AbstractRequest;
use NFSe\Entity\Issuer;
use NFSe\Entity\XmlEntity;
use NFSe\Environment;
use NFSe\Exception\NFSeRequestException;

/**
 * Class CancelationRequest
 *
 * @package NFSe\Request
 */
class CancelationRequest extends AbstractRequest
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
     * Send a XML file to cancelation
     * @param \NFSe\Entity\XmlEntity $xml
     * @return string Xml file content
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#tag/Cancelamento/paths/~1cancelamento~1notas~1cancela/post
     */
    public function cancel(XmlEntity $xml)
    {
        $this->setEndpoint("cancelamento/notas/cancela");

        return $this->execute($xml->generateCancelationXml());
    }
}
