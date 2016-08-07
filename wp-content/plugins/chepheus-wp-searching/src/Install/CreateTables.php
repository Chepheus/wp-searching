<?php

namespace App\Install;

use App\Config\DB;

class CreateTables implements CreateTablesInterface {
    protected $wpdb;
    protected $config;
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->config = new DB();
    }

    /**
     * @return array|bool
     */
    public function install()
    {
        if ($this->wpdb->get_var("SHOW TABLES LIKE '{$this->config->getTableName()}'")
            !== $this->config->getTableName()) {

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            return dbDelta($this->installTableSQL());
        }

        return false;
    }

    protected function installTableSQL($sql = '')
    {
        if (empty($sql)) {
            $sql = "CREATE TABLE {$this->config->getTableName()} (
	                    id int(11) NOT NULL AUTO_INCREMENT,
	                    token bigint(11) DEFAULT NULL,
	                    rtoken tinytext DEFAULT NULL,
	                    PRIMARY KEY id (id)
	                );";
        }
        return $sql;
    }
}