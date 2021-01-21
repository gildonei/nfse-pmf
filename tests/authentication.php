<?php
use NFSe\Entity\Issuer;
use NFSe\Environment;
use NFSe\Request\AuthenticationRequest;
use NFSe\Exception\EntityException;
use NFSe\Exception\NFSeRequestException;

require_once(realpath(dirname(__FILE__).'/').'/credentials.php');

try {
    $issuer = new Issuer();
    $issuer->setUsername($credentials['username'])
        ->setPassword($credentials['password'])
        ->setClientId($credentials['client_id'])
        ->setClientSecret($credentials['client_secret']);

    pr('ISSUER');
    pr($issuer);

    $environment = Environment::sandbox();
    pr('ENVIRONMENT');
    pr($environment);

    $authentication = new AuthenticationRequest($issuer, $environment);
    pr('AUTHENTICATION');
    pr($authentication);

    pr('SUCCESS?');
    var_dump($authentication->isAuthenticated());

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