<?php

namespace App;


use App\Config\MenuView;
use App\Install\CreateTables;
use App\View\Menu;
use Katzgrau\KLogger\Logger;

class App {
    /**
     * @var string
     */
    protected $file;

    /**
     * @var Logger
     */
    protected $logger;

    public function __construct($file, Logger $logger)
    {
        $this->file = $file;
        $this->logger = $logger;
    }

    public function install()
    {
        $createTables = new CreateTables();
        register_activation_hook($this->file, function() use ($createTables) {
            $this->_install($createTables);
        });
    }

    public function menuView()
    {
        (new Menu())->initMenu();
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