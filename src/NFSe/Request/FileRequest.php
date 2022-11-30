<?php

namespace NFSe\Request;

use NFSe\Request\AbstractRequest;
use NFSe\Entity\Issuer;
use NFSe\Environment;
use NFSe\Exception\NFSeRequestException;

/**
 * Class FilesRequest
 *
 * @package NFSe\Request
 */
class FileRequest extends AbstractRequest
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
     * @param array $param
     * @param string $type  Request type, default => GET. Allowed values POST, PUT, DELETE, GET
     * @param array $headers  Extra headers
     * @return mixed
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     */
    public function execute(array $param = [], $type = 'GET', array $headers = [])
    {
        if (empty($this->getEndpoint())) {
            throw new NFSeRequestException('Endpoint is empty!', 422);
        }
        $url = $this->getEnvironment()->getApiUrl() . $this->getEndpoint();
        if (!in_array(strtoupper($type), ['POST', 'PUT', 'DELETE', 'GET'])) {
            throw new \InvalidArgumentException('Invalid request type!');
        }
        $content = (empty($param)) ? null : (($type === 'GET') ? http_build_query($param) : json_encode($param));

        return $this->sendRequest($type, $url, $content, $headers);
    }

    /**
     * @access protected
     * @param mixed
     * @return mixed
     */
    protected function unserialize($data)
    {
        return $data;
    }

    /**
     * Get the XML content
     *
     * @param int $id NFSe Id
     * @param int $cmc CMC number
     * @return string XML file content
     * @throws NFSeRequestException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @see https://nfps-e-hml.pmf.sc.gov.br/consulta-frontend/#!/consulta
     */
    public function xml($id = null, $cmc = null, $name = null)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Id is empty');
        }
        if (empty($cmc)) {
            throw new \InvalidArgumentException('CMC is empty');
        }
        if (empty($name)) {
            throw new \InvalidArgumentException('Invoice end number is empty');
        }
        $this->setEndpoint("consultas/notas/xml/{$id}/{$cmc}/{$name}.xml");

        return $this->execute();
    }

    /**
     * Get the PDF metadata content
     *
     * @param int $id NFSe Id
     * @param int $cmc CMC number
     * @return string XML file content
     * @throws NFSeRequestException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @see https://nfps-e-hml.pmf.sc.gov.br/consulta-frontend/#!/consulta
     */
    public function pdf($id = null, $cmc = null)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Id is empty');
        }
        if (empty($cmc)) {
            throw new \InvalidArgumentException('CMC is empty');
        }
        $this->setEndpoint("pdf/notas/gerar/{$id}/{$cmc}");

        return $this->execute([], 'GET', [
            'Content-type' => 'Content-type: application/x-www-form-urlencoded',
        ]);
    }
}
