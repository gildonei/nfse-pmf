<?php

namespace NFSe\Request;

use DateInterval;
use DateTime;
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
     * @var DateTime
     */
    private $tokenExpiresIn;

    /**
     * @var string
     */
    private $grantType;

    /**
     * Constructor.
     *
     * @param \NFSe\Entity\Issuer $issuer
     * @param \NFSe\Environment $environment
     * @param string $grantType
     */
    public function __construct(Issuer $issuer, Environment $environment, $grantType = 'password')
    {
        parent::__construct($issuer, $environment);
        $this->setEndpoint('autenticacao/oauth/token');
        $this->setGrantType($grantType);
    }

    /**
     * @param array $param
     *      username => Issuer's username (login)
     *      password => Issuer's password
     *      client_id => Issuer's client id
     *      client_secret => Issuer's client secret
     * @return null
     * @throws \NFSe\Exception\NFSeRequestException
     * @throws \RuntimeException
     */
    public function execute(array $param = [])
    {
        if (empty($this->getEndpoint())) {
            throw new NFSeRequestException('Endpoint is empty!', 422);
        }
        $url = $this->getEnvironment()->getApiUrl() . $this->getEndpoint();

        if (empty($param)) {
            $param = [
                'grant_type' => $this->getGrantType(),
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
     * Unserialize and stores auth token
     * @param string $json
     * @return AuthenticationRequest
     */
    protected function unserialize($json)
    {
        $response = json_decode($json);
        $this->setAccessToken($response->access_token);
        $this->setTokenExpirationDate($response->expires_in);
        $this->getIssuer()->setAuthentication($this);

        return $this;
    }

    /**
     * Define Access Token
     * @param string $token
     * @throws \InvalidArgumentException
     * @return AuthenticationRequest
     */
    public function setAccessToken($token)
    {
        if (empty($token)) {
            throw new \InvalidArgumentException('Access Token is empty!');
        }
        $this->accessToken = $token;

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
     * Define Access Token expiration Date Time with given seconds
     * @param int $seconds
     * @throws \InvalidArgumentException
     * @return AuthenticationRequest
     */
    public function setTokenExpirationDate($seconds)
    {
        if (empty($seconds)) {
            throw new \InvalidArgumentException('Expiration seconds is empty!');
        }
        $this->tokenExpiresIn = (new DateTime())->add(new DateInterval("T{$seconds}S"));

        return $this;
    }

    /**
     * Return Access Token expiration Date Time
     * @return DateTime
     */
    public function getTokenExpirationDate()
    {
        return $this->tokenExpiresIn;
    }

    /**
     * Define grant type
     * @param string $grantType
     * @throws \InvalidArgumentException
     * @return AuthenticationRequest
     */
    public function setGrantType($grantType)
    {
        if (empty($grantType)) {
            throw new \InvalidArgumentException('Access Token is empty!');
        }
        $this->grantType = $grantType;

        return $this;
    }

    /**
     * Return grant type
     * @return string
     */
    public function getGrantTYpe()
    {
        return $this->grantType;
    }

    /**
     * Indicate if Issuer is authenticated
     * @return bool
     */
    public function isAuthenticated()
    {
        return !empty($this->getAccessToken());
    }

    /**
     * Indicate if access token is expired or not
     * @return bool
     */
    public function isAccessTokenExpired()
    {
        return (new DateTime() > $this->getTokenExpirationDate());
    }
}
