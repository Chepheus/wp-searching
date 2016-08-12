<?php

namespace App\Controllers;

use App\Config\MainConfig;

abstract class Controller {

    /**
     * @var array
     */
    private $get;

    /**
     * @var array
     */
    private $post;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }

    /**
     * @param $path
     * @param array $args
     * @return \Closure
     * @throws \Exception
     */
    protected function render($path, $args = [])
    {
        $pluginPath = MainConfig::getInstance()->getAttribute('pluginPath');
        $fullPath = $pluginPath . $path;
        $render = function () use ($fullPath, $args) {
            extract($args);
            include_once $fullPath;
        };
        $render();
    }

    private function validateKey($key, $requestMethod)
    {
        if (!is_string($key))
            throw new \Exception('Entered key must be string');

        switch (strtolower($requestMethod)) {
            case 'post':
                if (!key_exists($key, $this->post))
                    throw new \Exception("Post array hasn't this key");
                break;
            case 'get':
                if (!key_exists($key, $this->get))
                    throw new \Exception("Get array hasn't this key");
                break;
        }
    }

    protected function post($key = '')
    {
        $this->validateKey($key, 'post');
        return empty($key) ? $this->post : $this->post[$key];
    }

    protected function get($key = '')
    {
        $this->validateKey($key, 'get');
        return $this->get[$key];
    }
}