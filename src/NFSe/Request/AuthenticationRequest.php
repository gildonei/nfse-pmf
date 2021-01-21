<?php

namespace NFSe\Request;

use NFSe\Request\AbstractRequest;
use NFSe\Entity\Issuer;
use NFSe\Environment;
use NFSe\Exception\NFSeRequestException;

/**
 * Class AuthenticationRequest
 *
 * @package NFSe\Request
 */
class AuthenticationRequest extends AbstractRequest
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * Constructor.
     *
     * @param \NFSe\Entity\Issuer $issuer
     * @param \NFSe\Environment $environment
     */
    public function __construct(Issuer $issuer, Environment $environment)
    {
        parent::__construct($issuer, $environment);
        $this->setEndpoint('autenticacao/oauth/token');
    }

    /**
     * @param array $param
     *      username => Issuer's username (login)
     *      password => Issuer's password
     *      client_id => Issuer's client id
     *      client_secret => Issuer's client secret
     *
     * @return null
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     */
    public function execute($param = null)
    {
        if (empty($this->getEndpoint())) {
            throw new NFSeRequestException('Endpoint is empty!', 422);
        }
        $url = $this->getEnvironment()->getApiUrl() . $this->getEndpoint();

        if (empty($param)) {
            $param = [
                'grant_type' => 'password',
                'username' => $this->getIssuer()->getUsername(),
                'password' => $this->getIssuer()->getPassword(),
                'client_id' => $this->getIssuer()->getClientId(),
                'client_secret' => $this->getIssuer()->getClientSecret(),
            ];
        }

        $headers = [
            'Authorization' => 'Authorization: Basic ' . base64_encode($this->getIssuer()->getClientId() . ':' . $this->getIssuer()->getClientSecret())
        ];

        return $this->sendRequest('POST', $url, http_build_query($param), $headers);
    }

    /**
     * @param $json
     *
     * @return Authentication
     */
    protected function unserialize($json)
    {
        $response = json_decode($json);
        $this->setAccessToken($response->access_token);

        return $this;
    }

    /**
     * Define Access Token
     * @param string $token
     * @throws \InvalidArgumentException
     * @return Issuer
     */
    public function setAccessToken($token)
    {
        if (empty($token)) {
            throw new \InvalidArgumentException('Access Token is empty!');
        }
        $this->accessToken = $token;
        $this->getIssuer()->setAuthentication($this);

        return $this;
    }

    /**
     * Return Access Token
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Indicate if Issuer is authenticated
     * @return bool
     */
    public function isAuthenticated()
    {
        return !empty($this->getAccessToken());
    }
}