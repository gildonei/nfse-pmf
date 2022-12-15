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
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Emissão de NFPS-e</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Emissão de NFPS-e</h4>
            </div>
            <div class="card-body">
                <?php
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
                ?>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
<?php
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
