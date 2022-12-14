<?php
require_once(realpath(dirname(__FILE__).'/../').'/vendor/autoload.php');
require_once(realpath(dirname(__FILE__).'/').'/credentials.php'); //File needs to be created at same dir you run authentication file

use NFSe\Entity\Issuer;
use NFSe\Entity\XmlEntity;
use NFSe\Environment;
use NFSe\Request\AuthenticationRequest;
use NFSe\Exception\EntityException;
use NFSe\Exception\NFSeRequestException;
use NFSe\NFSeApi;

try {
    $issuer = new Issuer();
    $issuer->setUsername($credentials['username'])
        ->setPassword($credentials['password'])
        ->setClientId($credentials['client_id'])
        ->setClientSecret($credentials['client_secret']);

    $environment = Environment::sandbox();

    $authentication = new AuthenticationRequest($issuer, $environment);
    $authentication->execute();

    $reason = 'Teste de cancelamento';
    $nfseId = '544594';
    $aedf = '535413';
    $verificationCode = '36013962452E4274';

    $xml = new XmlEntity();
    $xml->getCancelation()
        ->setInvoiceNumber($nfseId)
        ->setAedf($aedf)
        ->setVerificationCode($verificationCode)
        ->setAedf($aedf);

    $nfse = new NFSeApi($issuer, $environment);

    $nfse->registerInvoice($xml);

} catch (EntityException $e) {
    echo "EntityException: " . $e->getMessage();
} catch (NFSeRequestException $e) {
    echo "NFSeRequestException: " . $e->getNFSeError()->getMessage();
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}

/**
 * <pre> echo a var
 * @param mixed $var
 */

function pr($var = '')
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
