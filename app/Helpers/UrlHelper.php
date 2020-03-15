<?php
/**
 * Created by PhpStorm.
 * User: LUIS
 * Date: 20/02/2019
 * Time: 12:39 PM
 */

namespace App\Helpers;


class UrlHelper
{
    public static function base(string $route):string
    {
        return _BASE_HTTP_ . $route;
    }

    public static function public(string $route):string
    {
        return _BASE_HTTP_ . "public/" . $route;
    }

    public static function redirect(string $url)
    {
        header(sprintf("Location: %s%s", _BASE_HTTP_, $url));
    }



}