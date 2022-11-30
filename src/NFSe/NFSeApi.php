<?php

namespace NFSe;

use DateTime;
use NFSe\Entity\Issuer;
use NFSe\Entity\XmlEntity;
use NFSe\Request\FileRequest;
use NFSe\Request\EmissionRequest;
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
     * @var \NFSe\Entity\Issuer
     */
    private $anonymousIssuer;

    /**
     * @var \NFSe\Environment
     */
    private $environment;

    /**
     * @var \NFSe\Request\ConsultationRequest;
     */
    private $consultation;

    /**
     * @var \NFSe\Request\EmissionRequest;
     */
    private $emission;

    /**
     * @var FileRequest;
     */
    private $file;

    /**
     * Create an instance of NFSeApi choosing the environment where the
     * requests will be send
     *      ::production
     *      ::sandbox
     *
     * @param \NFSe\Entity\Issuer $issuer The merchant credentials
     * @param \NFSe\Environment environment
     */
    public function __construct(Issuer $issuer, Environment $environment = null)
    {
        $this->setIssuer($issuer);
        $this->setEnvironment((empty($environment)) ? Environment::production() : $environment);
        $this->setConsultation(new ConsultationRequest($this->getIssuer(), $this->getEnvironment()));
        $this->setEmission(new EmissionRequest($this->getIssuer(), $this->getEnvironment()));
        $this->setFile(new FileRequest($this->getAnonymousIssuer(), $this->getEnvironment()));
    }

    /**
     * @access protected
     * @param Issuer $issuer
     * @return \NFSe\NFSeApi
     */
    protected function setIssuer(Issuer $issuer)
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * @access protected
     * @return \NFSe\Entity\Issuer
     */
    protected function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * Made this way because PMF uses same anonymous user to perform the search and
     * send response
     *
     * @access protected
     * @return \NFSe\Entity\Issuer
     */
    protected function getAnonymousIssuer()
    {
        return ($this->getEnvironment()->production()) ?
            (new Issuer())
                ->setClientId('consulta2-nfpse-client')
                ->setClientSecret('7077dbc51dec13a289ece2177cc6efa8') :

            (new Issuer())
                ->setClientId('consulta-nfpse-client')
                ->setClientSecret('2ca53c015bef55767f7064d1c5159d45');
    }

    /**
     * @access protected
     * @param \NFSe\Environment $environment
     * @return NFSeApi
     */
    protected function setEnvironment(Environment $environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * @access protected
     * @return \NFSe\Environment
     */
    protected function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @access protected
     * @param \NFSe\Request\ConsultationRequest $consultation
     * @return NFSeApi
     */
    protected function setConsultation(ConsultationRequest $consultation)
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * @access protected
     * @return \NFSe\Request\ConsultationRequest
     */
    protected function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * @access protected
     * @param \NFSe\Request\EmissionRequest $emission
     * @return NFSeApi
     */
    protected function setEmission(EmissionRequest $emission)
    {
        $this->emission = $emission;

        return $this;
    }

    /**
     * @access protected
     * @return \NFSe\Request\EmissionRequest
     */
    protected function getEmission()
    {
        return $this->emission;
    }

    /**
     * @access protected
     * @param \NFSe\Request\FileRequest $file
     * @return NFSeApi
     */
    protected function setFile(FileRequest $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @access protected
     * @return \NFSe\Request\FileRequest
     */
    protected function getFile()
    {
        return $this->file;
    }

    /**
     * Returns an array with all emitted invoices in a date range
     *
     * @param DateTime $startDate
     * @param DateTime $endDate
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
    public function consultInvoiceByDateInterval(DateTime $startDate, DateTime $endDate)
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
     * @return \NFSe\Entity\Invoice
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     */
    public function consultInvoiceByVerificationCodeCmc($verificationCode, $cmc)
    {
        return $this->getConsultation()->verificationCodeCmc($verificationCode, $cmc);
    }

    /**
     * Returns the date of last emitted invoice by provider CMC
     *
     * @param int $cmc
     * @return DateTime
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

    /**
     * Return an array of valid fields for input search
     * @access public
     * @return array
     */
    public function getValidSearchFields()
    {
        return $this->getConsultation()->getValidSearchFields();
    }

    /**
     * Register Invoice using regular and full schema
     * @access public
     * @param \NFSe\Entity\XmlEntity
     * @return string Xml file content
     */
    public function registerInvoice(XmlEntity $xml)
    {
        return $this->getEmission()->regular($xml);
    }

    /**
     * Validate
     * @access public
     * @param \NFSe\Entity\XmlEntity
     * @return string
     */
    public function validateXml(XmlEntity $xml)
    {
        return $this->getEmission()->validateXml($xml);
    }

    /**
     * Return the XML file from NFSe
     * @access public
     * @param int $id NFSe Id
     * @param int $cmc Issuer CMC
     * @param string $name Xml name
     * @return string
     */
    public function getXml($id, $cmc, $name)
    {
        return $this->getFile()->xml($id, $cmc, $name);
    }

    /**
     * Return the PDF metadata from NFSe
     * @access public
     * @param int $id NFSe Id
     * @param int $cmc Issuer CMC
     * @return string
     */
    public function getPdf($id, $cmc)
    {
        return $this->getFile()->pdf($id, $cmc);
    }
}
