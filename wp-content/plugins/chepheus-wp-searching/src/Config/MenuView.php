<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.08.2016
 * Time: 23:40
 */

namespace App\Config;


class MenuView {
    protected $pageTitle = 'WP Searching';
    protected $menuTitle = 'WP Searching';
    protected $capability = 'manage_options';
    protected $menuSlug = 'chepheus-wp-searching';
    protected $iconUrl = '';
    protected $position = null;

    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function getMenuTitle()
    {
        return $this->menuTitle;
    }

    public function getCapability()
    {
        return $this->capability;
    }

    public function getMenuSlug()
    {
        return $this->menuSlug;
    }

    public function getIconUrl()
    {
        return $this->iconUrl;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPageTitle($value)
    {
        $this->pageTitle = $value;
    }

    public function setMenuTitle($value)
    {
        $this->menuTitle = $value;
    }

    public function setCapability($value)
    {
        $this->capability = $value;
    }

    public function setMenuSlug($value)
    {
        $this->menuSlug = $value;
    }

    public function setIconUrl($value)
    {
        $this->iconUrl = $value;
    }

    public function setPosition($value)
    {
        $this->position = $value;
    }
}