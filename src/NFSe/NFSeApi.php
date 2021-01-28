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
     * @var \NFSe\Request\ConsultationRequest;
     */
    private $consultation;

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
        $this->setConsultation(new ConsultationRequest($this->getIssuer(), $this->getEnvironment()));
    }

    /**
     * @access protected
     * @param Issuer $issuer
     * @return NFSeApi
     */
    protected function setIssuer(Issuer $issuer)
    {
        $this->issuer = $issuer;

        return $this;
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
     * @param Environment $environment
     * @return NFSeApi
     */
    protected function setEnvironment(Environment $environment)
    {
        $this->environment = $environment;

        return $this;
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
     * @access protected
     * @param ConsultationRequest $consultation
     * @return NFSeApi
     */
    protected function setConsultation(ConsultationRequest $consultation)
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * @access public
     * @return ConsultationRequest
     */
    public function getConsultation()
    {
        return $this->consultation;
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
        return $this->getConsultation()->dateInterval($startDate, $endDate);
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
        return $this->getConsultation()->aedfInvoiceNumbers($aedf, $startNumber, $endNumber);
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
        return $this->getConsultation()->aedfInvoiceNumbers($verificationCode, $cmc);
    }

    /**
     * Returns the date of last emitted invoice by provider CMC
     *
     * @param int $cmc
     * @return \DateTime
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     */
    public function consultLastInvoiceDateByCmc($cmc)
    {
        return $this->getConsultation()->lastDateByCmc($cmc);
    }

    /**
     * Returns the date of last emitted invoice by provider CMC
     *
     * @param array $data   Array containing POST data
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
    public function consultByPostFields(array $data = [])
    {
        return $this->getConsultation()->postFields($data);
    }
}
