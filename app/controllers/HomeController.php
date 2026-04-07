<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../core/Request.php";

class HomeController extends Controller {
    public function index() {
        view('index');
    }
}