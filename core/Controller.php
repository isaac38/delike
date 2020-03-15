<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 11/02/2019
 * Time: 07:50 AM
 */

namespace Core;


class Controller
{
    protected $provider;

    public function __construct()
    {
        $config=ServicesContainer::getConfig();

        $load=new \Twig_Loader_Filesystem(
            _APP_PATH_."Views/"
        );

        $this->provider=new \Twig_Environment(
            $load,
            array(
                "cache"=>!$config["cache"]?false:_CACHE_PATH_,
                "debug"=>true
            )
        );

        $this->provider->addExtension(
            new \Twig_Extension_Debug()
        );

        $this->addCustomeFilter();
    }

    /*A QUI TERMINA EL CONTRUCTOR DE LA CLASE*/

    public function addCustomeFilter()
    {
        $this->provider->addFilter(
            new \Twig_SimpleFilter(
             "url",
             ["App\\Helpers\\UrlHelper",
                 "base"]
            )

        );

        $this->provider->addFilter(
            new \Twig_SimpleFilter(
                "public",
                ["App\\Helpers\\UrlHelper",
                    "public"]
            )

        );
    }

    protected function render(string $view, array $data=[]):string {
        return $this->provider->render($view,$data);
    }
}