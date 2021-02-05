<?php
require_once(realpath(dirname(__FILE__).'/').'/vendor/autoload.php');
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
            ->setName('Saudesc Adm de Planos de Ass a Saúde Ltda ME')
            ->setCnpj('05.973.701/0001-20')
            ->setCmc(4250419)
            ->setAedf(129617)
            ->setEmail('test@saudesc.com.br')
            ->setPhone(
                $xml->getProvider()->getPhone()
                ->setCountryCode(55)
                ->setAreaCode(48)
                ->setNumber(39520800)
            )
            ->setAddress(
                $xml->getProvider()->getAddress()
                ->setStreet('Rua Vidal Ramos')
                ->setStreetNumber(110)
                ->setComplement('Sala 07 - Térreo')
                ->setDistrict('Centro')
                ->setCity('Florianópolis')
                ->setCityCode($cityCode)
                ->setState('SC')
                ->setZipcode('88010320')
            )
        )
        ->setTaker(
            $xml->getTaker()
            ->setName('Lupa Informática')
            ->setCompanyName('Lupa Informática Ltda EPP')
            ->setEmail('test@lupainformatica.com.br')
            ->setDocument('04.632.076/0001-90')
            ->setCmc(5354137)
            ->setPhone(
                $xml->getTaker()->getPhone()
                ->setCountryCode(55)
                ->setAreaCode(48)
                ->setNumber(30352366)
            )
            ->setAddress(
                $xml->getTaker()->getAddress()
                ->setStreet('Rua Campolino Alves')
                ->setStreetNumber(300)
                ->setComplement('Ed. Continente Office Prime - Sl 08')
                ->setDistrict('Capoeiras')
                ->setCity('Florianópolis')
                ->setCityCode($cityCode)
                ->setState('SC')
                ->setZipcode('88085110')
            )
        )
        ->setTotalValue(39.90)
        ->setBaseCalc(39.90)
        ->setBaseCalcReplacement(0)
        ->setIssqn(0)
        ->setIssqnReplacement(0)
        ->setCfps($cfps)
        ->addService(
            $xml->getService()
            ->setIdCnae(8475)
            ->setRateValue(3)
            ->setDescription('Plano Flex+')
            ->setUnitValue(39.83)
            ->setAmount(1)
            ->setTotalValue(39.83)
            ->setCst(1)
        )
        ->setSignature($signature);

    $xml->generateXml();

    $nfse = new NFSeApi($issuer, $environment);

    $nfse->getEmission()->regular($xml);

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
