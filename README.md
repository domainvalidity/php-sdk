# Doma(in)Validity PHP SDK.

Light PHP SDK to interact with the Doma(in)Validity API.

## Usage

```php
<?php

require_once 'vendor/autoload.php';

use Domainvalidity\Sdk\Factory;

$host = Factory::make()->validate('https://api.example.com');

$host->isValid(); // true or false
$host->original(); // https://api.example.com
$host->host(); // 'api.example.com'
$host->domain(); // example.com
$host->tld(); // com
```