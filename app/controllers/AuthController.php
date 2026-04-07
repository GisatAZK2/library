<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../core/Request.php";
require_once __DIR__ . "/../models/Auth.php";

class AuthController extends Controller {
    public function viewsLoginAdmin() {
        view('auth.login-admin');
    }

    public function viewsLoginAnggota() {
        view('auth.login-anggota');
    }

    public function viewsRegristasiAnggota() {
        view('auth.regristasi-anggota');
    }

    public function StoreRegristasi () {
        if (Request::empty()) {
            return redirect('/regist');
        }
        

        $auth = new Auth();

        $auth->insertanggota(Request::all());
        return redirect('/regist');
    }

    public function StoreLogin() {}

    public function logout () {
        session_start();
        session_destroy();
    }
}