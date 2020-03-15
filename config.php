<?php


return[
    "database"=>[
        "driver"=>"mysql",
        "host"=>"127.0.0.1",
        "database"=>"pasteleria",
        "username"=>"root",
        "password"=>"", //contraseña de tu Mysql
        "charset"=>"utf8",
        "collation"=>"utf8_unicode_ci",
        "prefix"=>""
    ],
    "session-time"=>10,
    "session_name"=>"application-auth",
    "secret-key"=>"undermyfeet1234566789",
    "environment"=>"dev", //prod, stop
    "timezone"=>"America/Hermosillo",
    "cache"=>false,
    "company"=>"Delike"
];