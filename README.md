Boskee Esendex Bundle
=============================

*By [boskee](http://boskee.co.uk/)*

[![Build Status](https://secure.travis-ci.org/boskee/esendex-bundle.png)](http://travis-ci.org/boskee/esendex-bundle)
[![Latest Stable Version](https://poser.pugx.org/boskee/esendex-bundle/v/stable.png)](https://packagist.org/packages/boskee/esendex-bundle)
[![Total Downloads](https://poser.pugx.org/boskee/esendex-bundle/downloads.png)](https://packagist.org/packages/boskee/esendex-bundle)

This bundle enables you to use [`Esendex SDK`](https://github.com/esendex/sdk) as a service in your Symfony project.

For more information see the [esendex/sdk](https://github.com/esendex/sdk) repository and the [Esendex REST API](http://developers.esendex.com/APIs/REST-API).


## Requirements

* Symfony
* Dependencies:
 * [`Esendex SDK`](https://github.com/esendex/sdk)

## Installation

### Add in your composer.json

```js
{
    "require": {
        "boskee/esendex-bundle": "dev-master"
    }
}
```

### Install the bundle

``` bash
$ curl -s http://getcomposer.org/installer | php
$ php composer.phar update boskee/esendex-bundle
```

Composer will install the bundle to your project's `vendor/boskee` directory.

### Enable the bundle via the kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Boskee\EsendexBundle\BoskeeEsendexBundle(),
    );
}
```

## Configuration

### config.yml

```yaml
boskee_esendex:
    account_reference: "..."
    username: "..."
    password: "..."
```

## Usage

After installation and configuration, the service can be directly referenced from within your controllers.

```php
<?php

$esendex = $this->get('boskee_esendex.dispatcher');

// Create a Text Message
$message = new Boskee\EsendexBundle\Model\TextMessage();
$message->setOriginator('Boskee');
$message->setRecipient('01234567890');
$message->setBody('Test message');

$response = $esendex->send($message->prepare());

```

## License

This bundle is under the MIT license. For the full copyright and license information, please view the LICENSE file that
was distributed with this source code.
