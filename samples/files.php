<?php
require_once(realpath(dirname(__FILE__).'/../').'/vendor/autoload.php');
require_once(realpath(dirname(__FILE__).'/').'/credentials.php'); //File needs to be created at same dir you run authentication file

use NFSe\Entity\Issuer;
use NFSe\Environment;
use NFSe\Request\AuthenticationRequest;
use NFSe\Exception\EntityException;
use NFSe\Exception\NFSeRequestException;
use NFSe\NFSeApi;

try {
    $issuer = new Issuer();
    $issuer->setClientId('consulta-nfpse-client') // Ambiente de homologação da PMF para clientes anônimos
        ->setClientSecret('2ca53c015bef55767f7064d1c5159d45');

    $environment = Environment::sandbox();

    $authentication = new AuthenticationRequest($issuer, $environment);
    $authentication->execute();

    $nfseId = 1;
    $signature = null;
    $cityCode = 4205407; // Pode ser obtido no site do viaCep https://www.viacep.com.br
    $cfps = 9201; // Tomador domiciliado no município do emissor

    $id = 'NFSe ID';
    $cmc = 'Issue CMC';
    $name = 'XML File Name Without Extension';

    $nfse = new NFSeApi($issuer, $environment);

    $xml = $nfse->getXml($id, $cmc, $name);
    // header('Content-type: text/xml');
    // echo $xml;
    // pr(htmlspecialchars($xml));

    $pdf = $nfse->getPdf($id, $cmc);
    // header('Content-type: application/pdf');
    // echo base64_decode($pdf);

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
