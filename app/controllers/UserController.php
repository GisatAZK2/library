<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../core/Request.php";

class UserController extends Controller {

   public function __construct() {
    if (!$_SESSION['id_user']) {
        redirect('/');
        exit;
    }
   }
    public function index() {
        view('users');
    }
}