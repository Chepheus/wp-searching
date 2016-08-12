<?php

namespace App\Config;

class MainConfig {
    private static $instance;
    private $settings = [];

    private function __construct(){}
    private function __clone(){}

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setAttribute($key, $value)
    {
        $this->settings[$key] = $value;
    }

    public function getAttribute($key)
    {
        if (! key_exists($key, $this->settings))
            throw new \Exception("Key doesn't exists");

        return $this->settings[$key];
    }
}