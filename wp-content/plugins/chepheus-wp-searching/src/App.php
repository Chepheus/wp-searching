<?php

namespace App;

use App\Config\MainConfig;
use App\Container\ControllerContainer;
use App\Install\CreateTables;
use App\Controllers\MenuController;
use Katzgrau\KLogger\Logger;

class App {
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var ControllerContainer
     */
    protected $controllerContainer;

    public function __construct(Logger $logger, ControllerContainer $controllerContainer)
    {
        $this->logger = $logger;
        $this->controllerContainer = $controllerContainer;
    }

    public function install()
    {
        $createTables = new CreateTables();
        $file = MainConfig::getInstance()->getAttribute('pluginEntryFile');
        register_activation_hook($file, function() use ($createTables) {
            $this->_install($createTables);
        });
    }

    public function menuView()
    {
        /** @var MenuController $menuController */
        $menuController = $this->controllerContainer->getController('menu');
        if ($menuController) {
            $menuController->initMenu();
        }
    }

    private function _install(CreateTables $createTables)
    {
        $result = $createTables->install();
        if (is_array($result)) {
            $this->logger->notice('Creating table response: ', $result);
        } else {
            $this->logger->notice('Creating table response: ' . (int) $result);
        }
    }

    public function getControllerContainer()
    {
        return $this->controllerContainer;
    }
}