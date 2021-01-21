<?php
require_once(realpath(dirname(__FILE__).'/').'/vendor/autoload.php');
require_once(realpath(dirname(__FILE__).'/').'/credentials.php'); //File needs to be created at same dir you run authentication file

use NFSe\Entity\Issuer;
use NFSe\Environment;
use NFSe\Request\AuthenticationRequest;
use NFSe\Exception\EntityException;
use NFSe\Exception\NFSeRequestException;


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
