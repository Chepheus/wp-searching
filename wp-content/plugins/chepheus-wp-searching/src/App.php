<?php

namespace App;


use App\Install\CreateTables;
use Katzgrau\KLogger\Logger;

class App {
    /**
     * @var string
     */
    protected $file;

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
            $result = $createTables->install();
            if (is_array($result)) {
                $this->logger->notice('Creating table response: ', $result);
            } else {
                $this->logger->notice('Creating table response: ' . (int) $result);
            }
        });
    }
}