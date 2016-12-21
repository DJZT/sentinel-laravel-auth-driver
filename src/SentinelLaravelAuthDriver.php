<?php 

namespace Djzt\SentinelLaravelAuthDriver\Drivers\Auth;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class SentinelAuthDriver implements Guard
{

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        return \Sentinel::check();
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return \Sentinel::guest();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return \Sentinel::getUser();
    }

    /**
     * Log a user into the application without sessions or cookies.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function once(array $credentials = [])
    {
        return \Sentinel::stateless($credentials);
    }

    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param  array  $credentials
     * @param  bool   $remember
     * @param  bool   $login
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false, $login = true)
    {
        return \Sentinel::authenticate($credentials, $remember);
    }

    /**
     * Attempt to authenticate using HTTP Basic Auth.
     *
     * @param  string  $field
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function basic($field = 'email')
    {
        \Sentinel::basic();
    }

    /**
     * Perform a stateless HTTP Basic login attempt.
     *
     * @param  string  $field
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function onceBasic($field = 'email')
    {
        return null;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        return \Sentinel::validateCredentials($credentials);
    }

    /**
     * Log a user into the application.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  bool  $remember
     * @return void
     */
    public function login(Authenticatable $user, $remember = false)
    {
        return \Sentinel::login($user, $remember);
    }

    /**
     * Log the given user ID into the application.
     *
     * @param  mixed  $id
     * @param  bool   $remember
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function loginUsingId($id, $remember = false)
    {
        $user = User::findOrFail($id);
        return $this->login($user->id, $remember);
    }

    /**
     * Determine if the user was authenticated via "remember me" cookie.
     *
     * @return bool
     */
    public function viaRemember()
    {
        return false;
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout()
    {
        \Sentinel::logout();
    }
}