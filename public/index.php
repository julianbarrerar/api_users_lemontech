<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Models\User;
use App\Controllers\UserController;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;

Router::get('/users', function (Request $req, Response $res) {
  (new UserController())->index($req, $res);
});

Router::get('/user/([0-9]*)', function (Request $req, Response $res) {
  (new UserController())->show($req, $res);
});

Router::post('/user', function (Request $req, Response $res) {
  (new UserController())->store($req, $res);
});

Router::put('/user/([0-9]*)', function (Request $req, Response $res) {
  (new UserController())->update($req, $res);
});

Router::delete('/user/([0-9]*)', function (Request $req, Response $res) {
  (new UserController())->destroy($req, $res);
});