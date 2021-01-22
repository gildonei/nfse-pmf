# Instructions for using samples

EX: Assuming you use WAMP in Windows x64, your default localhost dir is C:\wamp64\www.
1. First step you can create a dir called `nfse` in `C:\wamp64\www`
2. Using windows `prompt` you will run `cd C:\wamp64\www\nfse`
3. Inside `nfse` dir, you must install NFSe the package using `composer require gildonei/nfse-pmf`
4. Copy all sample files inside `/vendor/gildonei/NFSe/samples/` to `C:\wamp64\www\nfse` dir
5. Create a new file called `credentials.php` in `C:\wamp64\www\nfse`
6. Add an array with your credentials
```php
$credentials = [
    'username' => 'your company CMC (Inscrição Municipal)',
    'password' => 'MD5 of your password in PMF website',
    'client_id' => 'your developer client_id',
    'client_secret' => 'your developer client_secret',
];

```
7. Run your tests like `http://localhost/nfse/authentication.php`

## Obtaining client_id and client_secret
To obtain a client id and secret you must access [https://nfps-e.pmf.sc.gov.br/frontend/#!/credenciais-integracao](https://nfps-e.pmf.sc.gov.br/frontend/#!/credenciais-integracao) fill and submit the form.

Those tokens are used both for production and homolog environments. They also are unique and can be used to all applications you want to integrate.

Projects will be distinguished by username and password that are unique to each company
