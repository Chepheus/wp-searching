<?php

namespace App;

use App\Config\MainConfig;
use App\Install\CreateTables;
use App\Controllers\MenuController;
use Katzgrau\KLogger\Logger;

class App {
    /**
     * @var Logger
     */
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
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
        (new MenuController($_POST))->initMenu();
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
}