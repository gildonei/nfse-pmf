<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;

/**
 * Entity Provider
 *
 * @author Gildonei Mendes Anacleto Junior <junior@sitecomarte.com.br>
 */
class Provider extends AbstractEntity
{
    /**
     * Name
     * @var string
     */
    private $name;

    /**
     * CMC (Código Municipal Contribuinte ou IM Inscrição Municipal - Contributor Municipal Code)
     * @var int
     */
    private $cmc;

    /**
     * Provider document - CNPJ - Cadastro Nacional de Pessoa Jurídica
     * @var int
     */
    private $cnpj;

    /**
     * Define name
     * @param string $name
     * @throws \InvalidArgumentException
     * @return Provider
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
     * Define cmc
     * @param string $cmc
     * @throws \InvalidArgumentException
     * @return Provider
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
     * @return string
     */
    public function getCmc()
    {
        return $this->cmc;
    }

    /**
     * Define cnpj
     * @param string $cnpj
     * @throws \InvalidArgumentException
     * @return Provider
     */
    public function setCnpj($cnpj)
    {
        if (empty($cnpj)) {
            throw new \InvalidArgumentException('CNPJ is empty!');
        }
        $this->cnpj = $cnpj;

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
}
