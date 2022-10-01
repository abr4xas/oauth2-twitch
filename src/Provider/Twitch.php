<?php

namespace Abr4xas\Oauth2Twitch\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Twitch extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * @inheritDoc
     */
    public function getBaseAuthorizationUrl(): string
    {
        return 'https://id.twitch.tv/oauth2/authorize';
    }

    /**
     * @inheritDoc
     */
    public function getBaseAccessTokenUrl(array $params): string
    {
        return 'https://id.twitch.tv/oauth2/token';
    }

    /**
     * @inheritDoc
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return "https://api.twitch.tv/helix/users?oauth_token={$token->getToken()}";
    }

    /**
     * @inheritDoc
     */
    protected function getDefaultScopes(): array
    {
        return ['user:read:email'];
    }

    /**
     * @inheritDoc
     */
    protected function getScopeSeparator(): string
    {
        return ' ';
    }

    /**
     * @inheritDoc
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode >= 400) {
            throw new IdentityProviderException(
                $data['description'] ?? $response->getReasonPhrase(),
                $statusCode,
                $response
            );
        }
    }

    /**
     * @inheritDoc
     */
    protected function createResourceOwner(array $response, AccessToken $token): TwitchResourceOwner|ResourceOwnerInterface
    {
        return new TwitchResourceOwner($response);
    }

    /**
     * @inheritDoc
     */
    protected function getDefaultHeaders(): array
    {
        return [
            'Client-ID' => $this->clientId,
            'Accept' => 'application/vnd.twitchtv.v5+json',
        ];
    }
}
