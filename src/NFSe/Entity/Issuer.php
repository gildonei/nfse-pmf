<?php

namespace NFSe\Entity;

use NFSe\Entity\AbstractEntity;
use NFSe\Request\AuthenticationRequest;

/**
 * Entity Issuer
 *
 * @author Gildonei Mendes Anacleto Junior <junior@sitecomarte.com.br>
 */
class Issuer extends AbstractEntity
{
    /**
     * Username (login)
     * @var string
     */
    private $username;

    /**
     * Password
     * @var string
     */
    private $password;

    /**
     * Api Key
     * @var string
     */
    private $clientId;

    /**
     * Payee code
     * @var string
     */
    private $clientSecret;

    /**
     * @var AuthenticationRequest
     */
    private $authenticationRequest;

    /**
     * Define username
     * @param string $username
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Issuer
     */
    public function setUsername($username)
    {
        if (empty($username)) {
            throw new \InvalidArgumentException('Username is empty!');
        }
        $this->username = $username;

        return $this;
    }

    /**
     * Return username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Define password
     * @param string $pswd
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Issuer
     */
    public function setPassword($pswd)
    {
        if (empty($pswd)) {
            throw new \InvalidArgumentException('Password is empty!');
        }
        $this->password = $pswd;

        return $this;
    }

    /**
     * Return password
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Define Client Id
     * @param string $key
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Issuer
     */
    public function setClientId($key)
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('API Client Id is empty!');
        }

        $this->clientId = $key;

        return $this;
    }

    /**
     * Return Client Id
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Define Client Secret
     * @param string $key
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Issuer
     */
    public function setClientSecret($key)
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('API Client Secret is empty!');
        }
        if (strlen($key) !== 32) {
            throw new \InvalidArgumentException('Client Secret must have 32 chars length!');
        }
        $this->clientSecret = $key;

        return $this;
    }

    /**
     * Return Client Secret
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param \NFSe\Request\AuthenticationRequest $authentication
     * @throws \InvalidArgumentException
     * @return \NFSe\Entity\Issuer
     */
    public function setAuthentication(AuthenticationRequest $authentication)
    {
        $this->authenticationRequest = $authentication;

        return $this;
    }

    /**
     * Return Authentication request
     * @return null|\NFSe\Request\AuthenticationRequest
     */
    public function getAuthentication()
    {
        return $this->authenticationRequest;
    }
}
