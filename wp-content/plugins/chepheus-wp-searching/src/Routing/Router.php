<?php

namespace App\Routing;

use App\App;
use App\Container\ControllerContainer;

class Router {

    protected $app;

    protected $request;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = new Request();
        $this->app->menuView();
    }

    public function routing()
    {
        $rout = $this->request->getRout();
        if ($rout) {
            $controller = $this->app->getControllerContainer()->getController($rout[0]);
            $action = 'action' . ucfirst($rout[1]);
            if (method_exists($controller, $action)) {
                $controller->{$action}();
            } else {
                throw new \Exception("Action {$action} doesn't exist!");
            }
        }

    }


}