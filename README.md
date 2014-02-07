### WPN-XM API Client

| Branch | Unit Tests | Code Coverage | Code Quality | Dependencies
| ------ | ---------- | -------- | ------- | ------- |
| [![Latest Stable Version](https://poser.pugx.org/wpn-xm/api-client/v/stable.png)](https://packagist.org/packages/wpn-xm/api-client) | [![Build Status](https://travis-ci.org/WPN-XM/api-client.png)](https://travis-ci.org/WPN-XM/api-client) | [![Code Coverage](https://scrutinizer-ci.com/g/wpn-xm/api-client/badges/coverage.png?s=d5f1f3d8d60acface9af5703812a1b7824fcce7c)](https://scrutinizer-ci.com/g/wpn-xm/api-client/)| [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/wpn-xm/api-client/badges/quality-score.png?s=8e702e4ca0581aba6d83279c7ad2b480e8ca5aab)](https://scrutinizer-ci.com/g/wpn-xm/api-client/) | [![Dependency Status](https://www.versioneye.com/package/php--ksst--kf/badge.png)](https://www.versioneye.com/package/php--wpn-xm--api-client)

The official PHP API client for the WPN-XM Software Component Registry.

Please use the [issues](https://github.com/wpn-xm/api-client/issues) section to
report any bugs or feature requests and to see the list of known issues.

## Installation

Please use [Composer](http://getcomposer.org/) for download and installation.
Please add this project as a local, per-project dependency to your project,
by simply adding the following line to your project's `composer.json` file.

    {
        "require": {
            "wpn-xm/api-client": "dev-master"
        }
    }

## Usage

### Developer Hint

If using "xdebug", then set "xdebug.max_nesting_level = 200".

### Authentication

##### Without authentication

```php
$client = new WPNXM\API\Client();

// with options
$client = new WPNXM\API\Client(array(), $options);
```

##### OAuth with "access_token" authentication

```php
$client = new WPNXM\API\Client('YourAccessToken', $options);
```

##### OAuth with "client_secret" authentication

```php
$auth = array('client_id' => '123', 'client_secret' => 'YourClientSecret');

$client = new WPNXM\API\Client($auth, $options);
```

