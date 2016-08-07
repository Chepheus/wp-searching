<?php

namespace App\View;

use App\Config\MenuView;

class Menu {
    /**
     * @var MenuView
     */
    protected $config;

    public function __construct()
    {
        $this->config = new MenuView();
    }

    public function initMenu()
    {
        $callable = function () {
            echo 'Hello my menu!';
        };
        add_action('admin_menu', function() use ($callable) {
            add_menu_page(
                $this->config->getPageTitle(),
                $this->config->getMenuTitle(),
                $this->config->getCapability(),
                $this->config->getMenuSlug(),
                $callable,
                $this->config->getIconUrl(),
                $this->config->getPosition()
            );
        });
    }
}