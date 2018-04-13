<?php

class IndexController extends ControllerBase
{
    /** @var UserAuthenticatorInterface */
    private $authenticator;

    public function setAuthenticator(UserAuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function indexAction()
    {
        if ($this->authenticator->isUserLoggedIn()) {
            $this->response->redirect('/search');
        }
    }

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $successfullLogin = $this->authenticator->logIn($this->request);

            if ($successfullLogin === false) {
                $this->flashSession->error('Invalid login details, try user/pass');
            }
        }
        $this->response->redirect('/');
    }

    public function logoutAction()
    {
        $this->authenticator->logOut();
        $this->response->redirect('/');
    }

}

