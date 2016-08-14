<?php

namespace App\Routing;

class RoutHelper {
    protected $request;
    public function __construct()
    {
        $this->request = new Request();
    }

    public function createRoute($path)
    {
        return preg_match('/rout=[^&]*/', $path)
            ? $this->replaceRout($path)
            : $this->request->getCurrentPath() . "&rout={$path}";
    }

    protected function replaceRout($path)
    {
        return str_replace(
            '/rout=[^&]*/',
            "rout={$path}",
            $this->request->getCurrentPath()
        );
    }
}