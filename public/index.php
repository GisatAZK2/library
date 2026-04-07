<?php

require_once __DIR__ . "/../app/core/Helpers.php";
require_once __DIR__ . "/../routes/web.php";

session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION === 'admin') {
        redirect('/admin-dashboard');
        exit;
    } elseif ($_SESSION === 'angota') {
        redirect('/anggota-dashboard');
        exit;
    } 
}

Router::dispatch();