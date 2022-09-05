
# Laravel Parampos

Laravel Parampos Integration


## Install Via Composer

`composer require makaraman/laravel-parampos`



## Publish Config
`php artisan vendor:publish --provider=Makaraman\Parampos\Providers\ParamposServiceProvider --tag=config`
## Usage

```
// use Makaraman\Parampos\Parampos;

$parampos = new Parampos();
$parampos
    ->setTestMode(true) // DEFAULT FALSE | IT CHANGES BASE API URL
    // ->setApiUrl('string') // (OPTIONAL) | DEFUALT API URL COMES FROM config/parampos.php
    ->setCreditCard([
        'card_owner' => 'Test', // REQUIRED
        'card_number' => '4022774022774026', // REQUIRED | 16 DIGITS
        'card_month' => '12', // REQUIRED | 2 DIGITS
        'card_year' => '26', // REQUIRED | 2 DIGITS
        'card_cvc' => '000', // REQUIRED | 3 DIGITS
    ])
    ->setIpAddress($_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR']) // (REQUIRED)
    ->setOrderId(time()) // (REQUIRED) | Specific Order ID
    ->setOrderDescription('Order Description') // (OPTIONAL) | Order Description
    ->setInstallmentRate('3') // (REQUIRED) | DEFAULT 1
    ->setInstallmentAmount(325) // (REQUIRED) | DEFAULT 0
    ->setTotalAmount(1436.88) // (REQUIRED) | Greater than 0
    ->setSecureType('3D') // (REQUIRED) | 3D (for 3DSECURE) or NS (for NONSECURE)
    ->setSuccessUrl('success-url') // REQUIRED | Return URL
    ->setFailureUrl('failure-url') // REQUIRED | Return URL
    ->send(); // send() -> to make request | debugger() in order to see what are sent in request
