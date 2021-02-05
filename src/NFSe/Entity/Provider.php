<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;
use NFSe\Entity\Phone;

/**
 * Entity Provider
 *
 * @package NFSe\Entity
 */
class Provider extends AbstractEntity
{
    /**
     * Name
     * @var string
     */
    private $name;

    /**
     * Email
     * @var string
     */
    private $email;

    /**
     * CMC (Código Municipal Contribuinte ou IM Inscrição Municipal - Contributor Municipal Code)
     * @var int
     */
    private $cmc;

    /**
     * AEDF number (Authorization for Invoice Emission - Autorização para Emissão de Nota Fiscal)
     * @var int
     */
    private $aedf;

    /**
     * Provider document - CNPJ - Cadastro Nacional de Pessoa Jurídica
     * @var int
     */
    private $cnpj;

    /**
     * Taker address
     * @var \NFSe\Entity\Address
     */
    private $address;

    /**
     * Taker address
     * @var \NFSe\Entity\Phone
     */
    private $phone;

    /**
     * Define name
     * @param string $name
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Provider
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
     * Define email
     * @param string $email
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Provider
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
     * @return \NFSe\Entity\Provider
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
     * Define cnpj
     * @param string $cnpj
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Provider
     */
    public function setCnpj($cnpj)
    {
        if (empty($cnpj)) {
            throw new \InvalidArgumentException('CNPJ is empty!');
        }
        $this->cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        return $this;
    }

    /**
     * Return cnpj
     * @return string
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Define taker address
     * @param \NFSe\Entity\Address $address
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Provider
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
     * Sets AEDF value
     * @param int $aedf
     * @return \NFSe\Entity\Provider
     * @throws \InvalidArgumentException
     */
    public function setAedf($aedf)
    {
        if (!is_numeric($aedf)) {
            throw new \InvalidArgumentException('AEDF must be a number!');
        }
        if (!is_numeric($aedf)) {
            throw new \InvalidArgumentException('AEDF must be a number!');
        }
        $this->aedf = $aedf;

        return $this;
    }

    /**
     * Return provider AEDF
     * @return int
     */
    public function getAedf()
    {
        return $this->aedf;
    }

    /**
     * Define taker phone
     * @param \NFSe\Entity\Phone $phone
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Provider
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
