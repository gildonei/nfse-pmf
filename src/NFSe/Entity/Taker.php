<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;
use NFSe\Entity\Phone;

/**
 * Entity Taker
 *
 * @package NFSe\Entity
 */
class Taker extends AbstractEntity
{
    /**
     * Taker name
     * @var string
     */
    private $name;

    /**
     * Taker's company name
     * @var string
     */
    private $companyName;

    /**
     * Taker's email
     * @var string
     */
    private $email;

    /**
     * CMC (Código Municipal Contribuinte ou IM Inscrição Municipal - Contributor Municipal Code)
     * @var int
     */
    private $cmc;

    /**
     * Taker document
     * @var string (CPF/CNPJ)
     */
    private $document;

    /**
     * Taker address
     * @var \NFSe\Entity\Address
     */
    private $address;

    /**
     * Taker additional data
     * @var string
     */
    private $additionalData;

    /**
     * Taker address
     * @var \NFSe\Entity\Phone
     */
    private $phone;

    /**
     * Define name
     * @param string $name
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Taker
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name is empty!');
        }
        $this->name = $name;

        return $this;
    }

    /**
     * Return name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Define name
     * @param string $name
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Taker
     */
    public function setCompanyName($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Company name is empty!');
        }
        $this->companyName = $name;

        return $this;
    }

    /**
     * Return name
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Define email
     * @param string $email
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Taker
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new \InvalidArgumentException('Email is empty!');
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid email address!');
        }
        $this->email = $email;

        return $this;
    }

    /**
     * Return email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Define cmc
     * @param int $cmc
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Taker
     */
    public function setCmc($cmc)
    {
        if (empty($cmc)) {
            throw new \InvalidArgumentException('CMC is empty!');
        }
        if (!is_numeric($cmc) || $cmc <= 0) {
            throw new \InvalidArgumentException('CMC must be numeric!');
        }
        $this->cmc = $cmc;

        return $this;
    }

    /**
     * Return cmc
     * @return int
     */
    public function getCmc()
    {
        return $this->cmc;
    }

    /**
     * Define document
     * @param string $document
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Taker
     */
    public function setDocument($document)
    {
        if (empty($document)) {
            throw new \InvalidArgumentException('Document is empty!');
        }
        $this->document = preg_replace('/[^0-9]/', '', $document);

        return $this;
    }

    /**
     * Return document
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Define taker address
     * @param \NFSe\Entity\Address $address
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Taker
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Return district
     * @return \NFSe\Entity\Address
     */
    public function getAddress()
    {
        return (empty($this->address)) ? new Address() : $this->address;
    }

    /**
     * Define additional data
     * @param string $data
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Taker
     */
    public function setAdditionalData($data)
    {
        if (strlen($data) > 600) {
            throw new \InvalidArgumentException('Additional data exceeds 600 char length!');
        }
        $this->additionalData = $data;

        return $this;
    }

    /**
     * Return additional data
     * @return string
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * Define taker phone
     * @param \NFSe\Entity\Phone $phone
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Taker
     */
    public function setPhone(Phone $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Return phone
     * @return \NFSe\Entity\Phone
     */
    public function getPhone()
    {
        return (empty($this->phone)) ? new Phone() : $this->phone;
    }
}
