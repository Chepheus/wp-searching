<?php
/*
Plugin Name: chepheus-wp-searching
Plugin URI: https://github.com/Chepheus/wp-searching
Description: Object oriented searching plugin for WordPress
Author: Anton Zamniborsch
Version: 0.0.1
*/

require_once __DIR__ . '/vendor/autoload.php';

$logger = new \Katzgrau\KLogger\Logger(__DIR__ . '/logs');
$app = new \App\App(__FILE__, $logger);
$app->install();