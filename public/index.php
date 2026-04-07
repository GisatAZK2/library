<?php

require_once __DIR__ . "/../app/core/Helpers.php";
require_once __DIR__ . "/../routes/web.php";

session_start();

$currentUrl = $_SERVER['REQUEST_URI'];
$role = $_SESSION['role'] ?? null;

if ($role === 'admin' && $currentUrl !== '/admin-dashboard') {
    redirect('/admin-dashboard');
    exit;
}

if ($role === 'anggota' && $currentUrl !== '/dashboard') {
    redirect('/dashboard');
    exit;
}

Router::dispatch();