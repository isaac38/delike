<?php

namespace Core;


class ServicesContainer
{
    private static $config;
    private static $dbContext = false;

    public static function getConfig():array {
        return self::$config;
    }

    public static function setConfig($value) {
        self::$config = $value;
    }

    public static function InitializeDBContext(){
        if(!self::$dbContext){
            DbContext::initialize();
            self::$dbContext=true;
        }
    }
}