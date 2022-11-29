<?php

namespace NFSe\Entity;

use DateTime;
use NFSe\Entity\AbstractEntity;
use NFSe\Entity\Provider;
use NFSe\Entity\Taker;

/**
 * Class Invoice
 *
 * @author Gildonei Mendes Anacleto Junior <junior@sitecomarte.com.br>
 */
class Invoice extends AbstractEntity
{
    /**
     * Invoice Id
     * @var int
     */
    private $id;

    /**
     * Invoice provider
     * @var Provider
     */
    private $provider;

    /**
     * Invoice taker
     * @var Taker
     */
    private $taker;

    /**
     * Invoice emitted date
     * @var DateTime
     */
    private $emitted;

    /**
     * Invoice processed date
     * @var DateTime
     */
    private $processed;

    /**
     * Invoice cancelled date
     * @var DateTime
     */
    private $cancelled;

    /**
     * Invoice value
     * @var float   0.00
     */
    private $value;

    /**
     * Invoice ISS tax value
     * @var float   0.00
     */
    private $iss;

    /**
     * CFPS - Código Fiscal de Prestação de Serviços
     * @var int
     */
    private $cfps;

    /**
     * Invoice cancel reason
     * @var string
     */
    private $cancelReason;

    /**
     * Invoice number
     * @var int
     */
    private $number;

    /**
     * Invoice day
     * @var int
     */
    private $day;

    /**
     * Invoice month
     * @var int
     */
    private $month;

    /**
     * Invoice year
     * @var int
     */
    private $year;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var string
     */
    private $verificationCode;

    /**
     * @var string
     */
    private $identification;

    /**
     * flDecl
     * @var string S/N
     */
    private $decl;

    /**
     * competenciaDecl
     * @var DateTime
     */
    private $declDate;

    /**
     * Is opting for SIMPLES NACIONAL
     * @var string S/N
     */
    private $simples;

    /**
     * Define invoice id
     * @param int $id
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setId($id)
    {
        $id = (int)$id;
        if ($id  <= 0) {
            throw new \InvalidArgumentException('Invoice Id must be a positive number!');
        }
        $this->id = $id;

        return $this;
    }

    /**
     * Returns invoice id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Define invoice provider
     * @param \NFSe\Entity\Provider $provider
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setProvider(Provider $provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Returns invoice provider
     * @return \NFSe\Entity\Provider
     */
    public function getProvider()
    {
        return (is_null($this->provider)) ? new Provider : $this->provider;
    }

    /**
     * Define invoice taker
     * @param \NFSe\Entity\Taker  $taker
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setTaker(Taker $taker)
    {
        $this->taker = $taker;

        return $this;
    }

    /**
     * Returns invoice taker
     * @return \NFSe\Entity\Taker
     */
    public function getTaker()
    {
        return (is_null($this->taker)) ? new Taker() : $this->taker;
    }

    /**
     * Define invoice emitted date
     * @param DateTime $date
     * @return \NFSe\Entity\Invoice
     */
    public function setEmitted(\DateTime $date)
    {
        $this->emitted = $date;

        return $this;
    }

    /**
     * Returns invoice emitted date
     * @return DateTime
     */
    public function getEmitted()
    {
        return $this->emitted;
    }

    /**
     * Define invoice processed date
     * @param DateTime $date
     * @return \NFSe\Entity\Invoice
     */
    public function setProcessed(\DateTime $date)
    {
        $this->processed = $date;

        return $this;
    }

    /**
     * Returns invoice processed date
     * @return DateTime
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * Define invoice cancelled date
     * @param null|DateTime $date
     * @return \NFSe\Entity\Invoice
     */
    public function setCancelled(\DateTime $date = null)
    {
        $this->cancelled = $date;

        return $this;
    }

    /**
     * Returns invoice cancelled date
     * @return DateTime
     */
    public function getCancelled()
    {
        return $this->cancelled;
    }

    /**
     * Define cfps - Código Fiscal de Prestação de Serviços
     * @param string $cfps
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setCfps($cfps)
    {
        if (empty($cfps)) {
            throw new \InvalidArgumentException('CFPS is empty!');
        }
        $this->cfps = $cfps;

        return $this;
    }

    /**
     * Return cfps
     * @return string
     */
    public function getCfps()
    {
        return $this->cfps;
    }

    /**
     * Define cancel reason
     * @param null|string $reason
     * @return \NFSe\Entity\Invoice
     */
    public function setCancelReason($reason = null)
    {
        $this->cancelReason = $reason;

        return $this;
    }

    /**
     * Return cancel reason
     * @return string
     */
    public function getCancelReason()
    {
        return $this->cancelReason;
    }

    /**
     * Define invoice number
     * @param int $number
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setNumber($number)
    {
        $number = (int)$number;
        if ($number  <= 0) {
            throw new \InvalidArgumentException('Invoice Number must be a positive number!');
        }
        $this->number = $number;

        return $this;
    }

    /**
     * Returns invoice number
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Define invoice value
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setValue($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('Invoice Value must be a float number!');
        }
        $this->value = $value;

        return $this;
    }

    /**
     * Returns invoice value
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Define invoice iss
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setIss($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('Invoice ISS must be a float number!');
        }
        $this->iss = $value;

        return $this;
    }

    /**
     * Returns invoice iss
     * @return float
     */
    public function getIss()
    {
        return $this->iss;
    }

    /**
     * Define invoice day
     * @param int $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setDay($value)
    {
        if (!preg_match('/^[0-9]{1,2}/', $value)) {
            throw new \InvalidArgumentException("Month invalid!");
        }
        if ($value < 1 || $value > 31) {
            throw new \InvalidArgumentException('Day must be between 1 and 31!');
        }
        $this->day = $value;

        return $this;
    }

    /**
     * Returns invoice day
     * @return int
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Define invoice month
     * @param int $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setMonth($value)
    {
        if (!preg_match('/^[0-9]{1,2}/', $value)) {
            throw new \InvalidArgumentException("Month invalid!");
        }
        if ($value < 1 || $value > 12) {
            throw new \InvalidArgumentException('Month must be between 1 and 12!');
        }
        $this->month = $value;

        return $this;
    }

    /**
     * Returns invoice month
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Define invoice year
     * @param int $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setYear($value)
    {
        $year = date('Y');
        if (!preg_match('/^[0-9]{4}/', $value)) {
            throw new \InvalidArgumentException("Year invalid!");
        }
        if ($value < 1900 || $value > $year) {
            throw new \InvalidArgumentException("Year must be between 1900 and {$year}!");
        }
        $this->year = $value;

        return $this;
    }

    /**
     * Returns invoice year
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Define invoice status
     * @param bool $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setStatus($value)
    {
        if ($value !== 0 & $value !== 1) {
            throw new \InvalidArgumentException("Status must be a 0 / 1!");
        }
        $this->status = $value;

        return $this;
    }

    /**
     * Returns invoice status
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Define invoice verificationCode
     * @param bool $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setVerificationCode($value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("Verification Code is empty!");
        }
        $this->verificationCode = $value;

        return $this;
    }

    /**
     * Returns invoice verificationCode
     * @return bool
     */
    public function getVerificationCode()
    {
        return $this->verificationCode;
    }

    /**
     * Define invoice identification
     * @param null|string $value
     * @return \NFSe\Entity\Invoice
     */
    public function setIdentification($value = null)
    {
        $this->identification = $value;

        return $this;
    }

    /**
     * Returns invoice identification
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Define invoice decl
     * @param string $value S | N
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setDecl($value)
    {
        if (empty($value) || !in_array(strtoupper($value), ['S', 'N'])) {
            throw new \InvalidArgumentException("Decl is invalid!");
        }
        $this->decl = $value;

        return $this;
    }

    /**
     * Returns invoice decl
     * @return string
     */
    public function getDecl()
    {
        return $this->decl;
    }

    /**
     * Define invoice declDate date
     * @param null|DateTime $date
     * @return \NFSe\Entity\Invoice
     */
    public function setDeclDate(\DateTime $date = null)
    {
        $this->declDate = $date;

        return $this;
    }

    /**
     * Returns invoice declDate date
     * @return DateTime|null
     */
    public function getDeclDate()
    {
        return $this->declDate;
    }

    /**
     * Define invoice simples
     * @param string $value  S | N
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Invoice
     */
    public function setSimples($value)
    {
        if (empty($value) || !in_array(strtoupper($value), ['S', 'N'])) {
            throw new \InvalidArgumentException("Simples is invalid!");
        }
        $this->simples = $value;

        return $this;
    }

    /**
     * Returns invoice simples
     * @return string
     */
    public function getSimples()
    {
        return $this->simples;
    }

    /**
     * Sets all invoice properties
     * @param array $data
     * [
     *      "aedf" => "string",
     *      "ano" => 0,
     *      "cdVerificacao" => "string",
     *      "cfps" => "string",
     *      "cmcPrestador" => "string",
     *      "competenciaDecl" => "string",
     *      "dataCancelamento" => "2019-08-24T14:15:22Z",
     *      "dataEmissao" => "2019-08-24T14:15:22Z",
     *      "dataProcessamento" => "2019-08-24T14:15:22Z",
     *      "dia" => 0,
     *      "emailTomador" => "string",
     *      "id" => 0,
     *      "identificacao" => "string",
     *      "identificacaoPrestador" => "string",
     *      "identificacaoTomador" => "string",
     *      "flDecl" => "string",
     *      "flSimpl" => "string",
     *      "mes" => 0,
     *      "motivoCancelamento" => "string",
     *      "nomePrestador" => "string",
     *      "nomeTomador" => "string",
     *      "numero" => 0,
     *      "status" => 0,
     *      "valorIss" => 0,
     *      "valorNota" => 0
     * ]
     * @return \NFSe\Entity\Invoice
     * @throws \InvalidArgumentException
     */
    public function hydrate(array $data = [])
    {
        $this->validateRequiredFields($data);

        $invoice = new Invoice();
        $provider = $invoice->getProvider()
            ->setName($data['nomePrestador'])
            ->setCmc($data['cmcPrestador'])
            ->setCnpj($data['identificacaoPrestador'])
            ->setAedf($data['aedf']);
        $taker = $invoice->getTaker()
            ->setName($data['nomeTomador'])
            ->setDocument($data['identificacaoTomador'])
            ->setEmail($data['emailTomador']);
        $invoice->setId($data['id'])
            ->setProvider($provider)
            ->setTaker($taker)
            ->setEmitted(new \DateTime($data['dataEmissao']))
            ->setProcessed(new \DateTime($data['dataProcessamento']))
            ->setCancelled((empty($data['dataCancelamento'])) ? null : new \DateTime($data['dataCancelamento']))
            ->setValue($data['valorNota'])
            ->setIss($data['valorIss'])
            ->setCfps($data['cfps'])
            ->setCancelReason($data['motivoCancelamento'])
            ->setNumber($data['numero'])
            ->setDay($data['dia'])
            ->setMonth($data['mes'])
            ->setYear($data['ano'])
            ->setStatus($data['status'])
            ->setVerificationCode($data['cdVerificacao'])
            ->setIdentification($data['identificacao'])
            ->setDecl($data['flDecl'])
            ->setDeclDate((empty($data['competenciaDecl'])) ? null : new \DateTime($data['competenciaDecl']))
            ->setSimples($data['flSimpl']);

        return $invoice;
    }

    /**
     * Validate if all key
     */
    private function validateRequiredFields(array $data = [])
    {
        if (empty($data)) {
            throw new \InvalidArgumentException('Data is empty!');
        }
        $error = [];
        $keys = array_keys($data);
        $requiredFields = $this->getRequiredFields();
        foreach ($keys as $key) {
            if (!in_array($key, $requiredFields)) {
                $error[] = $key;
            }
        }
        if (!empty($error)) {
            throw new \InvalidArgumentException('The field(s) ' . implode(', ', $error) . ' not set in Invoice data!');
        }

        return true;
    }

    /**
     * Returns an array with all required fields in an Invoice array data
     * @access private
     * @return array
     */
    private function getRequiredFields()
    {
        return [
            'id',
            'aedf',
            'identificacaoPrestador',
            'cmcPrestador',
            'nomePrestador',
            'identificacaoTomador',
            'nomeTomador',
            'emailTomador',
            'dataEmissao',
            'dataProcessamento',
            'dataCancelamento',
            'valorNota',
            'valorIss',
            'cfps',
            'motivoCancelamento',
            'numero',
            'dia',
            'mes',
            'ano',
            'status',
            'cdVerificacao',
            'identificacao',
            'flDecl',
            'competenciaDecl',
            'flSimpl'
        ];
    }
}
