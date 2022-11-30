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
    $issuer->setUsername($credentials['username'])
        ->setPassword($credentials['password'])
        ->setClientId($credentials['client_id'])
        ->setClientSecret($credentials['client_secret']);

    $environment = Environment::sandbox();


    $authentication = new AuthenticationRequest($issuer, $environment);
    $authentication->execute();

    $nfse = new NFSeApi($issuer, $environment);

    // pr('INVOICES BY DATE INTERVAL');
    // $invoices = $nfse->consultInvoiceByDateInterval(new DateTime('2020-12-01'), new DateTime('2020-12-31'));
    // pr($invoices);
    // pr('-----------------------------------');

    // pr('INVOICES BY AEDF AND NUMBER INTERVAL');
    // $invoices = $nfse->consultInvoiceByAedfInvoiceNumber('129617', 2330, 2339);
    // pr($invoices);
    // pr('-----------------------------------');

    // pr("INVOICE BY VERIFICATION CODE AND PROVIDER'S CMC");
    // $invoice = $nfse->consultInvoiceByVerificationCodeCmc('EBA81A2F1F995011', $credentials['username']);
    // pr($invoice);
    // pr('-----------------------------------');

    // pr("LAST INVOICE DATE BY PROVIDER'S CMC");
    // $invoice = $nfse->consultLastInvoiceDateByCmc($credentials['username']);
    // pr($invoice);
    // pr('-----------------------------------');

    // pr("INVOICE BY POST FIELDS");
    // $invoice = $nfse->consultByPostFields([
    //     'dataInicio' => '2020-12-01 00:00:00',
    //     'dataInicio' => '2020-12-31 00:00:00',
    //     'pagina' => 1,
    //     'ordenacaoDecrescente' => false,
    // ]);
    // pr($invoice);
    // pr('-----------------------------------');

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
