<?php

namespace NFSe\Request;

use DateTime;
use NFSe\Entity\Invoice;
use NFSe\Request\AbstractRequest;
use NFSe\Entity\Issuer;
use NFSe\Entity\Provider;
use NFSe\Environment;
use NFSe\Exception\NFSeRequestException;

/**
 * Class AuthenticationRequest
 *
 * @package NFSe\Request
 */
class ConsultationRequest extends AbstractRequest
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
     *      username => Issuer's username
     *      password => Issuer's password
     *      client_id => Issuer's client id
     *      client_secret => Issuer's client secret
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
     * @param \JsonSerializable $json
     * @return mixed
     */
    protected function unserialize($json)
    {
        return json_decode($json, true);
    }

    /**
     * Performs consultation of invoices by date range
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return array
     * [
     *      "notas": [
     *          [...]
     *      ],
     *      "pagina" => 0,
     *      "totalPaginas" => 0,
     *      "totalRegistros" =>  0,
     *      "registrosPorPagina" => 0
     * ]
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#operation/notaFiscalPorIntervaloDataUsingGET
     */
    public function dateInterval(\DateTime $startDate = null, \DateTime $endDate = null)
    {
        if ($endDate < $startDate) {
            throw new \InvalidArgumentException('Invalid date interval');
        }
        $this->setEndpoint("consultas/notas/data/{$startDate->format('Y-m-d')}/{$endDate->format('Y-m-d')}");

        return $this->execute();
    }

    /**
     * Performs consultation of invoices by AEDF and invoice number range
     *
     * @param string|int $aedf AEDF (Autorização Emissão Documento Fiscal)
     * @param int $startNumber  Invoice number
     * @param int $endNumber    Invoice number
     * @return array
     * [
     *      "notas": [
     *          [...]
     *      ],
     *      "pagina" => 0,
     *      "totalPaginas" => 0,
     *      "totalRegistros" =>  0,
     *      "registrosPorPagina" => 0
     * ]
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#operation/notaFiscalPorIntervaloNumeroEAedfUsingGET
     */
    public function aedfInvoiceNumbers($aedf = null, $startNumber = null, $endNumber = null)
    {
        if (empty($aedf)) {
            throw new \InvalidArgumentException('AEDF is empty');
        }
        if (empty($startNumber)) {
            throw new \InvalidArgumentException('Invoice start number is empty');
        }
        if (empty($endNumber)) {
            throw new \InvalidArgumentException('Invoice end number is empty');
        }
        $this->setEndpoint("consultas/notas/aedf/{$aedf}/numero/{$startNumber}/{$endNumber}");

        return $this->execute();
    }

    /**
     * Performs consultation of invoices by verification code and provider cmc
     *
     * @param string $code Invoice verification code
     * @param int $cmc  Provider cmc number
     * @return Invoice
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#operation/notaFiscalPorIntervaloNumeroEAedfUsingGET
     */
    public function verificationCodeCmc($code = null, $cmc = null)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException('Invoice Verification Code is empty');
        }
        if (empty($cmc)) {
            throw new \InvalidArgumentException('Provider CMC is empty');
        }
        $this->setEndpoint("consultas/notas/codigo/{$code}/{$cmc}");
        $invoice = new Invoice();

        return $invoice->hydrate($this->execute());
    }

    /**
     * Performs consultation of last invoice date emission by provider's cmc
     *
     * @param int $cmc  Provider cmc number
     * @return \DateTime
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#operation/dataUltimaNotaFiscalPorCmcUsingGET
     */
    public function lastDateByCmc($cmc = null)
    {
        if (empty($cmc)) {
            throw new \InvalidArgumentException('Provider CMC is empty');
        }
        $this->setEndpoint("consultas/notas/data/cmc");

        return new \DateTime($this->execute());
    }

    /**
     * Performs consultation of invoices by search fields
     * @param array $data   Array with post data
     * @return
     */
    public function postFields(array $data = [])
    {
        $this->setEndpoint("consultas/notas/filtro");

        $param = $this->validateSearchFields($data);
        $headers['Content-Type'] = 'Content-Type: application/json';

        return $this->execute($param, 'POST', $headers);
    }

    /**
     * Check if post fields are in allowed filters and return only the valid fields
     * @param array $fields     Array  containing a list of all post fields
     * @return array $validFields   Array containing only the valid fields
     */
    private function validateSearchFields(array $fields = [])
    {
        $validFields = [];
        if (empty($fields)) {
            return $validFields;
        }

        $allowed = $this->getValidSearchFields();

        foreach ($fields as $field => $value) {
            if (in_array($field, $allowed)) {
                $validFields[$field] = $value;
            }
        }

        return $validFields;
    }

    /**
     * Return an array with valid search fields
     * @access public
     * @return array
     */
    public function getValidSearchFields()
    {
        return [
            'cdVerificacao',
            'dataInicio',
            'dataFim',
            'id',
            'identificacaoPrestador',
            'razaoSocial',
            'identificacaoTomador',
            'numero',
            'numeroAedf',
            'numeroFim',
            'numeroInicio',
            'situacao',
            'idCnae',
            'ordenacaoDecrescente',
            'pagina',
        ];
    }
}
