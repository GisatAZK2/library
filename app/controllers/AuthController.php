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
        return redirect('/login-anggota');
    }

    public function StoreLogin() {
    if (Request::empty()) {
        return redirect('/');
    }

    session_start();

    $auth = new Auth();
    $data = Request::all();

    $user = $auth->findByLogin($data['username']);

    if (!$user) {
        return redirect('/');
    }

    if (!password_verify($data['password'], $user['password'])) {
        return redirect('/');
    }

    // simpan session
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    // 🚀 cek role langsung
    if ($user['role'] === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user['role'] === 'anggota') {
        return redirect('/dashboard');
    }

    // fallback kalau role aneh
    return redirect('/');
}

    public function logout () {
        session_start();
        session_destroy();
    }
}