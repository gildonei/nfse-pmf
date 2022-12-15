<?php
require_once(realpath(dirname(__FILE__).'/../').'/vendor/autoload.php');
require_once(realpath(dirname(__FILE__).'/').'/credentials.php'); //File needs to be created at same dir you run authentication file

use NFSe\Entity\Issuer;
use NFSe\Environment;
use NFSe\Request\AuthenticationRequest;
use NFSe\Exception\EntityException;
use NFSe\Exception\NFSeRequestException;
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

                pr('ISSUER');
                pr($issuer);
                pr('----------------------------');

                $environment = Environment::sandbox();
                pr('ENVIRONMENT');
                pr($environment);
                pr('----------------------------');

                $authentication = new AuthenticationRequest($issuer, $environment);
                $authentication->execute();
                pr('AUTHENTICATION');
                pr($authentication);
                pr('----------------------------');

                pr('SUCCESS?');
                var_dump($authentication->isAuthenticated());
                pr('----------------------------');

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
