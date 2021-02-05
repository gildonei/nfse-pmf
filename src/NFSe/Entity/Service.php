<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;

/**
 * Entity Service
 *
 * @package NFSe\Entity
 */
class Service extends AbstractEntity
{
    /**
     * Service rate value
     * @var float   999999,99
     */
    private $rateValue;

    /**
     * Service base calculation
     * @var float   999999,99
     */
    private $baseCalc;

    /**
     * Service description
     * @var string
     */
    private $description;

    /**
     * CST
     * @var int
     */
    private $cst;

    /**
     * ID CNAE
     * @var int
     */
    private $idCnae;

    /**
     * Service amount
     * @var int
     */
    private $amount;

    /**
     * Service total value
     * @var float
     */
    private $totalValue;

    /**
     * Service unit value
     * @var float
     */
    private $unitValue;

    /**
     * Define rate value
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Service
     */
    public function setRateValue($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('Base Calc must be a float number!');
        }
        $this->rateValue = $value;

        return $this;
    }

    /**
     * Returns rate value
     * @return float
     */
    public function getRateValue()
    {
        return $this->rateValue;
    }

    /**
     * Define base calc
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Service
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
     * Define street name
     * @param string $description
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Service
     */
    public function setDescription($description)
    {
        if (strlen($description) > 1500) {
            throw new \InvalidArgumentException('Service description exceeds maximum length 1500 chars!');
        }
        $this->description = $description;

        return $this;
    }

    /**
     * Return description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set service unit value
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Service
     */
    public function setUnitValue($value)
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            throw new \InvalidArgumentException('Unit Value must be a float number!');
        }
        $this->unitValue = $value;

        return $this;
    }

    /**
     * Returns service unit value
     * @return float
     */
    public function getUnitValue()
    {
        return $this->unitValue;
    }

    /**
     * Set CST
     * @param int $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Service
     */
    public function setCst($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('CST must be numeric!');
        }
        $this->cst = $value;

        return $this;
    }

    /**
     * Returns CST
     * @return int
     */
    public function getCst()
    {
        return $this->cst;
    }

    /**
     * Set ID CNAE
     * @param int $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Service
     */
    public function setIdCnae($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('CST must be numeric!');
        }
        $this->idCnae = $value;

        return $this;
    }

    /**
     * Returns ID CNAE
     * @return int
     */
    public function getIdCnae()
    {
        return $this->idCnae;
    }

    /**
     * Set service amount
     * @param int $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Service
     */
    public function setAmount($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Service amount must be numeric!');
        }
        if ($value <= 0) {
            throw new \InvalidArgumentException('Service amount invalid!');
        }
        $this->amount = $value;

        return $this;
    }

    /**
     * Returns service amount
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set service total value
     * @param float $value
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Service
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
     * Returns service total value
     * @return float
     */
    public function getTotalValue()
    {
        return $this->totalValue;
    }
}