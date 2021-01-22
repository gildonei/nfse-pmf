<?php
require_once(realpath(dirname(__FILE__).'/').'/vendor/autoload.php');
require_once(realpath(dirname(__FILE__).'/').'/credentials.php'); //File needs to be created at same dir you run authentication file

use NFSe\Entity\Invoice;
use NFSe\Entity\Issuer;
use NFSe\Environment;
use NFSe\Request\AuthenticationRequest;
use NFSe\Exception\EntityException;
use NFSe\Exception\NFSeRequestException;
use NFSe\Request\ConsultationRequest;

try {
    $issuer = new Issuer();
    $issuer->setUsername($credentials['username'])
        ->setPassword($credentials['password'])
        ->setClientId($credentials['client_id'])
        ->setClientSecret($credentials['client_secret']);

    $environment = Environment::production();


    $authentication = new AuthenticationRequest($issuer, $environment);
    $authentication->execute();

    $request = new ConsultationRequest($issuer, $environment);
    pr('INVOICES BY DATE INTERVAL');
    $invoices = $request->dateInterval(new DateTime(), new DateTime());
    pr($invoices);
    pr('-----------------------------------');

    pr('INVOICES BY AEDF AND NUMBER INTERVAL');
    $invoices = $request->aedfInvoiceNumbers('1111111', 0000, 0000);
    pr($invoices);
    pr('-----------------------------------');

    pr('LAST DATE BY CMC');
    $invoices = $request->lastDateByCmc($credentials['username']);
    pr($invoices);
    pr('-----------------------------------');

    pr("INVOICE BY VERIFICATION CODE AND PROVIDER'S CMC");
    $invoice = $request->verificationCodeCmc('xxxxxxxxxx', $credentials['username']);
    pr($invoice);
    pr('-----------------------------------');

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
