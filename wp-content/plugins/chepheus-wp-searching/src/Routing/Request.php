<?php

namespace App\Routing;

class Request {

    protected $get;
    protected $post;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }

    private function validate($key, $method)
    {
        if (! is_string($key) && ! key_exists($key, $this->{$method}))
            return false;

        return true;
    }

    private function similarLogic($method, $key)
    {
        if (empty($key)) return $this->{$method};
        return $this->validate($key, $method)
            ? $this->{$method}[$key] : false;
    }

    public function get($key = '')
    {
        return$this->similarLogic('get', $key);
    }

    public function post($key = '')
    {
        return $this->similarLogic('post', $key);
    }

    public function getCurrentPath()
    {
        return "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    }

    public function getRout()
    {
        preg_match('/rout=[^&]*/', $_SERVER['REQUEST_URI'], $matches);
        if (! is_null($matches[0])) {
            $rout = urldecode(str_replace('rout=', '', $matches[0]));
            return explode('/', $rout);
        }

        return false;
    }
}