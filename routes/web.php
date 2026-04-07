<?php

require_once __DIR__ . "/../app/core/Router.php";

Router::get('/', "HomeController@index");
Router::get('/login-anggota', "AuthController@viewsLoginAnggota");
Router::get('/regist', "AuthController@viewsRegristasiAnggota");
Router::post('/store-user',  "AuthController@StoreRegristasi");
Router::post('/store-login', "AuthController@StoreLogin");
Router::get('/users', "UserController@index");