<?php

interface UserAuthenticatorInterface
{
    /**
     * Tries to log in a user based on posted credentials
     * Returns true on success and false on failure
     *
     * @param \Phalcon\Http\Request $request
     * @return bool
     */
    public function logIn(\Phalcon\Http\Request $request):bool;


    /**
     * Check if user is logged in
     * Returns true on success and false on failure
     *
     * @return bool
     */
    public function isUserLoggedIn(): bool;

    /**
     * Logs out a user
     */
    public function logOut();


}