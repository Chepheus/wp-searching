<?php

namespace App\Config;

class DB {
    protected $wpdb;
    protected $tableName;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->setTableName();
    }

    public function setTableName($tableName = 'chepheus_searching')
    {
        $this->tableName = $this->wpdb->prefix . $tableName;
    }

    public function getTableName()
    {
        return $this->tableName;
    }
}