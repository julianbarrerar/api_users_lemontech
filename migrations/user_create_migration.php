<?php
require "../bootstrap.php";
use Illuminate\Database\Capsule\Manager as Capsule;

if (!Capsule::schema()->hasTable('users')) {
    Capsule::schema()->create('users', function ($table) {
           $table->increments('id');
           $table->string('name', 250);
           $table->string('email', 200)->unique();
           $table->string('password', 150);
           $table->string('userimage', 250)->nullable();
           $table->string('api_key')->nullable()->unique();
           $table->rememberToken();
           $table->softDeletes();
           $table->timestamps();
    });
    echo "Table user created successfully!!";
}else{
    echo "Table user exist!!";
}
