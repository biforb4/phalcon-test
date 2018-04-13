<?php

use Phalcon\Http\Request;
use Phalcon\Session\AdapterInterface;

class UserAuthenticator implements UserAuthenticatorInterface
{
    private $session;

    public function __construct(AdapterInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Checks if posted credentials are correct
     * Returns true on success and false on failure
     *
     * @param Request $request
     * @return bool
     */
    public function logIn(Request $request): bool
    {
        return $this->checkCredentials($request);
    }

    /**
     * Check if user is logged in
     * Returns true on success and false on failure
     *
     * @return bool
     */
    public function isUserLoggedIn(): bool
    {
        return $this->session->get('loggedIn') === true;
    }


    private function checkCredentials(Request $request): bool
    {
        if ($request->getPost('user') === 'user' && $request->getPost('password') === 'pass') {
            $this->session->set('loggedIn', true);
            return true;
        }
        return false;
    }

    /**
     * Logs out a user
     */
    public function logOut()
    {
        $this->session->remove('loggedIn');
    }
}