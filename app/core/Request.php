<?php

class Request {
    public static function all () {
        return $_POST;
    }
    public static function empty() {
        return empty($_POST);
    }
    public static function id() {
        return $_POST['id'] ?? null;
    }
}