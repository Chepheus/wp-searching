<?php

namespace App\Controllers;

use App\Config\MainConfig;
use App\Routing\Request;
use App\Routing\RoutHelper;

abstract class Controller {
    protected $request;
    public function __construct()
    {
        $this->request = new Request();
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
            $routHelper = new RoutHelper();
            include_once $fullPath;
        };
        $render();
    }
}