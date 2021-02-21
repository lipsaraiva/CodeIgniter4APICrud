<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use \App\Libraries\Oauth2;
use \OAuth2\Request;
use \OAuth2\Response;

class Oauth2Filter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $oauth = new Oauth2();
        $request = Request::createFromGlobals();
        $response = new Response();

        if(!$oauth->server->verifyResourceRequest($request)){
            $oauth->server->getResponse()->send();
            die();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}