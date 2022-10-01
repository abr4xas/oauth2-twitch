## Twitch Helix Provider for OAuth 2.0 Client

---

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abr4xas/oauth2-twitch.svg?style=flat-square)](https://packagist.org/packages/abr4xas/oauth2-twitch)
[![Tests](https://github.com/abr4xas/oauth2-twitch/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/abr4xas/oauth2-twitch/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/abr4xas/oauth2-twitch.svg?style=flat-square)](https://packagist.org/packages/abr4xas/oauth2-twitch)

This package provides Twitch (new version Helix) OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).


### Installation

You can install the package via composer:

```bash
composer require abr4xas/oauth2-twitch
```

### Usage

```php
$twitch = new \Abr4xas\Oauth2Twitch\Provider\Twitch([
    'clientId' => "CLIENT_ID",
    'clientSecret' => "CLIENT_SECRET",
    'redirectUri' => "http://localhost:8000",
]);

// get the authorization url
$url = $twitch->getAuthorizationUrl();

// get user info
if (isset($_GET['code'])) {
    try {
        $token = $twitch->getAccessToken("authorization_code", [
            'code' => $_GET['code'],
        ]);

        $user = $twitch->getResourceOwner($token);

        $userData = $user->toArray();

        // get specific info from your user
        // $user->getDisplayName();
        // $userData->getId()
        // $userData->getType();
        // $userData->getBio();
        // $userData->getEmail();
        // $userData->getPartnered();

        print("<pre>".print_r($userData, true)."</pre>");
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    }
}
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

### Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

### Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

### Credits

- [Angel](https://github.com/abr4xas)
- [All Contributors](../../contributors)

### License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
