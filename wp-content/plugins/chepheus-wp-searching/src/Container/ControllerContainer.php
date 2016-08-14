<?php

namespace App\Container;

use App\Controllers\Controller;

class ControllerContainer {
    /**
     * @var array
     */
    protected $controllers = [];

    /**
     * @param Controller $controller
     */
    public function addController(Controller $controller)
    {
        $reflection = new \ReflectionClass($controller);
        $controllerName = str_replace('Controller', '', $reflection->getShortName());
        $this->controllers[strtolower($controllerName)] = $controller;
    }

    /**
     * @param $rout
     * @return Controller|bool
     */
    public function getController($rout)
    {
        $routs = explode('/', $rout);
        $controllerName = str_replace('Controller', '', $routs[0]);
        if (! key_exists($controllerName, $this->controllers)) return false;

        return $this->controllers[strtolower($controllerName)];
    }
}