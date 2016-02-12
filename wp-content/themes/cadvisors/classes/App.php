<?php
namespace App;

use Pimple\Container;

class App extends Container
{

    public function __construct(array $values = [])
    {
        parent::__construct($values);

        foreach ($values as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    public function render($template, $data = [])
    {
        if(!isset($this['twig'])) {
            throw new \Exception('You must register the twig provider before you can use the render method');
        }

        $twig = $this['twig'];
        echo $twig->render($template, $data);
    }

}