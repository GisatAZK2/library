<?php

require_once __DIR__ . "/../app/core/Router.php";

Router::get('/', "HomeController@index");
Router::get('/users', "UserController@index");