<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Libraries\Oauth2;
use \OAuth2\Request;
use CodeIgniter\API\ResponseTrait;

class User extends Controller {

    use ResponseTrait;

    public function login(){
        $oauth = new Oauth2();
        $request = new Request();
        $respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
        $code = $respond->getStatusCode();
        $body = $respond->getResponseBody();
        return $this->respond(json_decode($body), $code);
    }

}