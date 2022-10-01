<?php

namespace Abr4xas\Oauth2Twitch\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class TwitchResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    public function __construct(protected array $response)
    {
        $this->response = $response['data'][0];
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return (int) $this->getValueByKey($this->response, 'id');
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->getValueByKey($this->response, 'login');
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->getValueByKey($this->response, 'display_name');
    }

    /**
     * @return string
     */
    public function getBroadcasterType(): string
    {
        return $this->getValueByKey($this->response, 'broadcaster_type');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getValueByKey($this->response, 'description');
    }

    /**
     * @return string
     */
    public function getProfileImageUrl(): string
    {
        return $this->getValueByKey($this->response, 'profile_image_url');
    }

    /**
     * @return string
     */
    public function getOfflineImageUrl(): string
    {
        return $this->getValueByKey($this->response, 'offline_image_url');
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return (int) $this->getValueByKey($this->response, 'view_count');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getValueByKey($this->response, 'email');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->getValueByKey($this->response, 'type');
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->response;
    }
}
