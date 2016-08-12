<?php

namespace App\Controllers;

use App\Config\MenuView;

class MenuController extends Controller {
    /**
     * @var MenuView
     */
    protected $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = new MenuView();
    }

    public function initMenu()
    {
        $callable = function () {
            $this->getMenuPage();
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

    protected function getMenuPage()
    {
        $this->render('/src/view/plugin-menu.phtml', ['title' => 'Hello!']);
    }
}