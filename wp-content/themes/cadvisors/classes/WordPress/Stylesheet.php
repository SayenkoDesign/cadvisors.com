<?php
/**
 * Created by PhpStorm.
 * User: rpark
 * Date: 2/9/2016
 * Time: 4:49 PM
 */

namespace App\WordPress;


class Stylesheet
{
    public $name;
    public $path;
    public $deps;
    public $version;
    public $media;

    public function __construct($name, $path, $deps = [])
    {
        $this->name = $name;
        $this->path = $path;
        $this->deps = $deps;
        $this->version = time();
        $this->media = 'all';
    }

    public function register()
    {
        wp_register_style($this->name, $this->path, $this->deps, $this->version, $this->media );
        wp_enqueue_style($this->name);
    }

    public function unregister()
    {
        wp_dequeue_style($this->name);
        wp_deregister_style($this->name);
    }
}