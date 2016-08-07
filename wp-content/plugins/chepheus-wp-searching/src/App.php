<?php

namespace App;


use App\Install\CreateTables;

class App {
    const APPDIR = __DIR__;
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function install()
    {
        $createTables = new CreateTables();
        register_activation_hook($this->file, function() use ($createTables) {
            $result = $createTables->install();
            file_put_contents(self::APPDIR . '/log.txt', print_r($result, true));
        });
    }
}