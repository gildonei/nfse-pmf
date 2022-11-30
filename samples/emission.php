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

    $nfseId = 1;
    $signature = null;
    $cityCode = 4205407; // Pode ser obtido no site do viaCep https://www.viacep.com.br
    $cfps = 9201; // Tomador domiciliado no município do emissor
    // $cfps = 9202; // Tomador domiciliado no município diferente do emissor
    // $cfps = 9203; // Tomador domiciliado no estado diferente do emissor

    $xml = new XmlEntity();
    $xml->setIdentification($nfseId)
        ->setProvider(
            $xml->getProvider()
            ->setName('Empresa Prestadora do Serviço')
            ->setCnpj('00.000.000/0000-00')
            ->setCmc(654321)
            ->setAedf(000000)
            ->setEmail('test@test.com')
            ->setPhone(
                $xml->getProvider()->getPhone()
                ->setCountryCode(55)
                ->setAreaCode(48)
                ->setNumber(33334444)
            )
            ->setAddress(
                $xml->getProvider()->getAddress()
                ->setStreet('Street Address')
                ->setStreetNumber(0)
                ->setComplement('Complement')
                ->setDistrict('Bairro')
                ->setCity('Cidade')
                ->setCityCode($cityCode)
                ->setState('SC')
                ->setZipcode('00000000')
            )
        )
        ->setTaker(
            $xml->getTaker()
            ->setName('Recebedor do Serviço')
            ->setCompanyName('Company Name do Recebedor')
            ->setEmail('test@test.com.br')
            ->setDocument('00.000.000/0000-00')
            ->setCmc(123456)
            ->setPhone(
                $xml->getProvider()->getPhone()
                ->setCountryCode(55)
                ->setAreaCode(48)
                ->setNumber(99998888)
            )
            ->setAddress(
                $xml->getProvider()->getAddress()
                ->setStreet('Street Address')
                ->setStreetNumber(0)
                ->setComplement('Complement')
                ->setDistrict('Bairro')
                ->setCity('Cidade')
                ->setCityCode($cityCode)
                ->setState('SC')
                ->setZipcode('00000000')
            )
        )
        ->setTotalValue(0.00)
        ->setBaseCalc(0.00)
        ->setBaseCalcReplacement(0)
        ->setIssqn(0)
        ->setIssqnReplacement(0)
        ->setCfps($cfps)
        ->addService(
            $xml->getService()
            ->setIdCnae(0000)
            ->setRateValue(0)
            ->setDescription('Service Description')
            ->setUnitValue(0.00)
            ->setAmount(1)
            ->setTotalValue(0.00)
            ->setCst(1)
        )
        ->setCertificatePath('./path/certificate/cert.pfx')
        ->setPassphrase('0000');

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
