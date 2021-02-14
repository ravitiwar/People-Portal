<?php


namespace App\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class AuthProxy
{
    protected $http;
    protected $userModel;

    function __construct(User $user)
    {
        $this->userModel = $user;
        $this->http = new Client([
            'base_uri' => env('APP_URL')
        ]);
    }

    /**
     * @param  string  $email
     * @param  string  $password
     * @return array
     * @throws InvalidCredentialsException
     */
    function login(string $email, string $password): array
    {
        try {
            $response = $this->http->post('/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $this->getPassworClientId(),
                    'client_secret' => $this->getPasswordClientSecret(),
                    'username' => $email,
                    'password' => $password
                ],
            ]);
            $response = (array)json_decode($response->getBody()->getContents());
            $response['details'] = $this->userModel->where('email', '=', $email)->with('role')->first();
            return  $response;

        } catch (\Exception $e) {
            throw new InvalidCredentialsException("Invalid Credentials");
        }
    }

    public function refreshToken(string $token): array
    {
        try {
            $response = $this->http->post('/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $token,
                    'client_id' => $this->getPassworClientId(),
                    'client_secret' => $this->getPasswordClientSecret(),
                ],
            ]);
            return (array)json_decode($response->getBody()->getContents());
        } catch (\Exception $exception) {
            throw new InvalidCredentialsException("Invalid refresh token");
        }
    }

    public function register(array $user_details): array
    {
        $user = User::create([
            'name' => $user_details['name'],
            'email' => $user_details['email'],
            'password' => Hash::make($user_details['password']),
        ]);
        return $this->login($user_details['email'], $user_details['password']);
    }

    protected function getPassworClientId(): string
    {
        return env('PASSWORD_ACCESS_CLIENT_ID');
    }


    protected function getPasswordClientSecret(): string
    {
        return env('PASSWORD_ACCESS_CLIENT_SECRET');
    }

}
