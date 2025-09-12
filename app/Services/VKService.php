<?php

namespace App\Services;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class VKService extends AbstractProvider implements ProviderInterface
{
    protected $scopes = ['email'];
    protected $scopeSeparator = ' ';

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://oauth.vk.com/authorize', $state);
    }

    protected function getTokenUrl()
    {
        return 'https://oauth.vk.com/access_token';
    }

    protected function getCodeFields($state = null)
    {
        $fields = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'response_type' => 'code',
            'scope' => $this->formatScopes($this->scopes, $this->scopeSeparator),
            'v' => '5.131',
        ];

        if ($this->usesState()) {
            $fields['state'] = $state;
        }

        return array_merge($fields, $this->parameters);
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.vk.com/method/users.get', [
            'query' => [
                'access_token' => $token,
                'v' => '5.131',
                'fields' => 'first_name,last_name,photo_max_orig,screen_name',
            ],
        ]);

        $response = json_decode($response->getBody(), true);

        return $response['response'][0] ?? null;
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['id'],
            'nickname' => $user['screen_name'] ?? null,
            'name' => trim($user['first_name'] . ' ' . $user['last_name']),
            'email' => $this->getEmail(),
            'avatar' => $user['photo_max_orig'] ?? null,
        ]);
    }

    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }

    protected function getEmail()
    {
        return $this->getAccessTokenResponse()['email'] ?? null;
    }
}
