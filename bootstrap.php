<?php
require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
   "driver"   => "mysql",
   "host"     => "db",
   "database" => "db_app",
   "username" => "root",
   "password" => "4Y2A4JC&p0l8"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();