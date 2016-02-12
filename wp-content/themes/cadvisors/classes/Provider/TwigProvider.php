<?php
namespace App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Twig_Environment;
use Twig_Extension_Debug;

class TwigProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['twig.loader'] = function($c){
            if(!isset($c['twig.paths'])) {
                throw new \Exception("TwigProvider requires twig.paths is configured");
            }

            return new \Twig_Loader_Filesystem(
                $c['twig.paths']
            );
        };

        $pimple['twig'] = function($c){
            $twig = new Twig_Environment(
                $c['twig.loader'],
                isset($c['twig.options']) ? $c['twig.options'] : [
                    'debug' => WP_DEBUG,
                    'cache' => false,
                    'auto_reload' => WP_DEBUG,
                    'strict_variables' => true,
                ]
            );
            $twig->addExtension(new Twig_Extension_Debug());
            return $twig;
        };
    }
}