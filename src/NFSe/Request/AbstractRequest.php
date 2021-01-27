<?php

namespace NFSe\Request;

use NFSe\Environment;
use NFSe\Entity\Issuer;
use NFSe\Exception\NFSeRequestException;
use NFSe\Exception\EntityException;

/**
 * Class AbstractRequest
 *
 * @package NFSe\Requisicoes
 */
abstract class AbstractRequest
{
    /**
     * Issuer of the bank sli´p
     * @var Issuer
     */
    private $issuer;

    /**
     * Issuer of the bank sli´p
     * @var Environment
     */
    private $environment;

    /**
     * API endpoint address
     * @var string
     */
    private $endpoint;

    /**
     * Constructor
     *
     * @param \NFSe\Entity\Issuer $issuer
     */
    public function __construct(Issuer $issuer, Environment $environment)
    {
        $this->setIssuer($issuer);
        $this->setEnvironment($environment);
    }

    /**
     * @param array $param
     * @return mixed
     */
    public abstract function execute(array $param = []);

    /**
     * @param string $method    GET, POST, PUT, DELETE
     * @param string $url   API and Endpoint address
     * @param \JsonSerializable|null $content
     * @return mixed
     * @throws \NFSe\API30\Ecommerce\Request\NFSeRequestException
     * @throws \RuntimeException
     */
    protected function sendRequest($method, $url, $content = null, array $extraHeaders = [])
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        switch ($method) {
            case 'GET':
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                break;
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        }
        if ($content !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
            $headers['Content-Type'] = 'Content-Type: application/x-www-form-urlencoded';
        } else {
            $headers['Content-Length'] = 'Content-Length: 0';
        }

        $headers = array_merge([
            'Accept' => 'Accept: */*',
            'Accept-Encoding' => 'Accept-Encoding: gzip, deflate, br',
            'User-Agent' => 'User-Agent: NFSe/1.0 PHP API',
            'RequestId' => 'RequestId: ' . md5(uniqid())
        ], $extraHeaders);

        if (empty($headers['Authorization'])) {
            $headers['Authorization'] = 'Authorization: Bearer '. $this->getIssuer()->getAuthentication()->getAccessToken();
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response   = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            throw new \RuntimeException('Curl error: ' . curl_error($curl));
        }
        curl_close($curl);

        return $this->readResponse($statusCode, $response);
    }

    /**
     * @param $statusCode
     * @param $responseBody
     *
     * @return mixed
     *
     * @throws NFSeRequestException
     */
    protected function readResponse($statusCode, $responseBody)
    {
        $unserialized = null;
        switch ($statusCode) {
            case 200:
            case 201:
                $unserialized = $this->unserialize($responseBody);
                break;

            case 400:
            case 422:
                $exception = null;
                $response  = json_decode($responseBody);

                if (isset($response->body)) {
                    foreach ($response->body as $error) {
                        $exception = new NFSeRequestException($error->message, $statusCode, $exception);
                    }
                } else {
                    $exception = new NFSeRequestException($response->message, $statusCode, null);
                }
                throw $exception;

            case 401:
            case 500:
                $response = json_decode($responseBody);
                throw new NFSeRequestException($response->message, $statusCode, null);

            case 404:
                throw new NFSeRequestException('Resource not found', 404, null);

            default:
                throw new NFSeRequestException('Unknown status', $statusCode);
        }

        return $unserialized;
    }

    /**
     * @abstract
     * @access protected
     * @param string $json
     * @return mixed
     */
    protected abstract function unserialize($json);

    /**
     * @access protected
     * @param string $url
     * @return void
     */
    protected function setEndpoint($url)
    {
        if (empty($url)) {
            throw new EntityException('Endpoint address is empty!');
        }
        $this->endpoint = $url;
    }

    /**
     * @access protected
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @access protected
     * @return Issuer
     */
    protected function setIssuer(Issuer $issuer)
    {
        return $this->issuer = $issuer;
    }

    /**
     * @access protected
     * @return Issuer
     */
    protected function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * @access protected
     * @return Environment
     */
    protected function setEnvironment(Environment $environment)
    {
        return $this->environment = $environment;
    }

    /**
     * @access protected
     * @return Environment
     */
    protected function getEnvironment()
    {
        return $this->environment;
    }
}
