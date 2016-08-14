<?php
/*
Plugin Name: chepheus-wp-searching
Plugin URI: https://github.com/Chepheus/wp-searching
Description: Object oriented searching plugin for WordPress
Author: Anton Zamniborsch
Version: 0.0.1
*/

require_once __DIR__ . '/vendor/autoload.php';

$mainConfig = \App\Config\MainConfig::getInstance();
$mainConfig->setAttribute('pluginPath', __DIR__);
$mainConfig->setAttribute('pluginEntryFile', __FILE__);

$controllerContainer = new \App\Container\ControllerContainer();
$controllerContainer->addController(new \App\Controllers\MenuController());
$controllerContainer->addController(new \App\Controllers\IndexingController());

$logger = new \Katzgrau\KLogger\Logger(__DIR__ . '/logs');
$app = new \App\App($logger, $controllerContainer);
$app->install();

$router = new App\Routing\Router($app);
$router->routing();
