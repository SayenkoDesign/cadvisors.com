<?php
/**
 * Created by PhpStorm.
 * User: rpark
 * Date: 2/9/2016
 * Time: 5:17 PM
 */

namespace App\WordPress;


class Script
{
    public $name;
    public $path;
    public $deps;
    public $version;
    public $footer;

    public function __construct($name, $path, $deps = [])
    {
        $this->name = $name;
        $this->path = $path;
        $this->deps = $deps;
        $this->version = time();
        $this->footer = true;
    }

    public function register()
    {
        wp_register_script($this->name, $this->path, $this->deps, $this->version, $this->footer );
        wp_enqueue_script($this->name);
    }

    public function unregister()
    {
        wp_dequeue_script($this->name);
        wp_deregister_script($this->name);
    }
}