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
        <title>Cancelamento de NFPS-e</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Cancelamento de NFPS-e</h4>
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

                    $reason = 'Teste de cancelamento';
                    $nfseId = '6';
                    $aedf = '535413';
                    $verificationCode = 'A48491E33A866A53';

                    $xml = new XmlEntity();
                    $xml->setCertificatePath('certificado.pfx')
                        ->setPassphrase($credentials['senha_certificado'])
                        ->setCancelation(
                            $xml->getCancelation()
                                ->setInvoiceNumber($nfseId)
                                ->setAedf($aedf)
                                ->setVerificationCode($verificationCode)
                                ->setReason($reason)
                        );

                    $nfse = new NFSeApi($issuer, $environment);

                    $result = $nfse->cancelInvoice($xml);

                    pr($result);

                } catch (EntityException $e) {
                    echo "EntityException: " . $e->getMessage() . '<hr>';
                    pr($xml);
                } catch (NFSeRequestException $e) {
                    echo "NFSeRequestException: " . $e->getNFSeError()->getMessage() . '<hr>';
                    pr(htmlspecialchars($xml->generateCancelationXml()));
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
