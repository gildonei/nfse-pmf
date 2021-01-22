<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;

class Taker extends AbstractEntity
{
    /**
     * Taker name
     * @var string
     */
    private $name;

    /**
     * Taker email
     * @var string
     */
    private $email;

    /**
     * Taker document
     * @var string (CPF/CNPJ)
     */
    private $document;

    /**
     * Define name
     * @param string $name
     * @throws \InvalidArgumentException
     * @return Taker
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
     * @return Taker
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new \InvalidArgumentException('Email is empty!');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
     * Define document
     * @param string $document
     * @throws \InvalidArgumentException
     * @return Taker
     */
    public function setDocument($document)
    {
        if (empty($document)) {
            throw new \InvalidArgumentException('Document is empty!');
        }
        $this->document = $document;

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
}
