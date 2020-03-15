<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 06/02/2019
 * Time: 01:08 PM
 */

namespace Core;
use Illuminate\Database\Capsule\Manager as Capsule;


class DbContext
{
    public static function initialize(){
        try{
            $config= ServicesContainer::getConfig();
            $capsule=new Capsule();
            $capsule->addConnection($config["database"]);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        }catch (\Exception $ex){
            Log::error(BdContext::class,$ex->getMessage());
        }
    }
}