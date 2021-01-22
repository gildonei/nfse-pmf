<?php

namespace NFSe;

use DateTime;
use NFSe\Entity\Issuer;
use NFSe\Entity\Invoice;
use NFSe\Request\ConsultationRequest;

/**
 * The NFSe API for creation and consult of bank slip.
 *
 * @package \NFSe
 */
class NFSeApi
{
    /**
     * @var \NFSe\Entity\Issuer
     */
    private $issuer;

    /**
     * @var \NFSe\Environment
     */
    private $environment;

    /**
     * Create an instance of NFSeApi choosing the environment where the
     * requests will be send
     *      ::production
     *      ::sandbox
     *
     * @param Issuer $issuer The merchant credentials
     * @param Environment environment
     */
    public function __construct(Issuer $issuer, Environment $environment = null)
    {
        $this->setIssuer($issuer);
        $this->setEnvironment((empty($environment)) ? Environment::production() : $environment);
    }

    /**
     * @access protected
     * @return Issuer
     */
    protected function setIssuer(Issuer $issuer)
    {
        return $this->issuer = $issuer;
    }

    /**
     * @access protected
     * @return Issuer
     */
    protected function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * @access protected
     * @return Environment
     */
    protected function setEnvironment(Environment $environment)
    {
        return $this->environment = $environment;
    }

    /**
     * @access protected
     * @return Environment
     */
    protected function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Returns an array with all emitted invoices in a date range
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
     */
    public function consultInvoiceByDateInterval(\DateTime $startDate, \DateTime $endDate)
    {
        $request = new ConsultationRequest($this->getIssuer(), $this->getEnvironment());

        return $request->dateInterval($startDate, $endDate);
    }

    /**
     * Returns an array with all emitted invoices in a date range
     *
     * @param int $aedf
     * @param int $startNumber
     * @param int $endNumber
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
     */
    public function consultInvoiceByAedfInvoiceNumber($aedf, $startNumber, $endNumber)
    {
        $request = new ConsultationRequest($this->getIssuer(), $this->getEnvironment());

        return $request->aedfInvoiceNumbers($aedf, $startNumber, $endNumber);
    }

    /**
     * Returns an array with invoice data
     *
     * @param string $verificationCode
     * @param int $cmc
     * @return Invoice
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     */
    public function consultInvoiceByVerificationCodeCmc($verificationCode, $cmc)
    {
        $request = new ConsultationRequest($this->getIssuer(), $this->getEnvironment());

        return $request->aedfInvoiceNumbers($verificationCode, $cmc);
    }
}