<?php

class SearchController extends ControllerBase
{
    /** @var UserAuthenticatorInterface */
    private $authenticator;

    public function beforeExecuteRoute() {
        if ($this->authenticator->isUserLoggedIn() === false) {
            $this->response->redirect('/');
        }
    }

    public function setAuthenticator(UserAuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function indexAction()
    {
        //render template
    }

    public function ajaxAction($search)
    {
        $search = str_replace(' ', '+', $search);
        $places = json_decode(
            file_get_contents('https://maps.googleapis.com/maps/api/place/textsearch/json?query=' . $search . '&key=' . $this->config->apiKey),
            true
        );

        $view = clone $this->view;
        $this->view->disable();

        if(count($places['results']) > 0) {
            $view->setViewsDir(__DIR__ . '/../views/'); // put here your dir
            echo $view->partial('partial/search',['results' => $places['results']]);
        } else {
            $this->response->setStatusCode('404', 'Not found');
        }
    }

}