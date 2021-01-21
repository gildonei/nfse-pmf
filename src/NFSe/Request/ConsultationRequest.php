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
     *
     * @return null
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     */
    public function execute($param = null)
    {
        if (empty($this->getEndpoint())) {
            throw new NFSeRequestException('Endpoint is empty!', 422);
        }
        $url = $this->environment->getApiUrl() . $this->getEndpoint();

        return $this->sendRequest('GET', $url, $param);
    }

    /**
     * @param $json
     *
     * @return Authentication
     */
    protected function unserialize($json)
    {
        return json_decode($json);
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
     * @throws \RuntimeException
     * @see https://nfps-e-hml.pmf.sc.gov.br/api/v1/doc/#operation/notaFiscalPorIntervaloDataUsingGET
     */
    public function dateInterval(\DateTime $startDate = null, \DateTime $endDate = null)
    {
        $this->setEndpoint("consultas/notas/data/{$startDate->format('Y-m-d')}/{$endDate->format('Y-m-d')}");

        return $this->unserialize($this->execute());
    }

    /**
     * Performs consultation of invoices by AEDF and invoice number range
     *
     * @param int $aedf AEDF (Autorização Emissão Documento Fiscal)
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

        return $this->unserialize($this->execute());
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

        return new Provider($this->execute());
    }

    /**
     * Performs consultation last date of invoice emission by provider cmc
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

        return new \DateTime($this->unserialize($this->execute()));
    }
}
