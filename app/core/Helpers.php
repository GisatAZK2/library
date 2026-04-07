<?php

function view ($files, $data=[]) {
        extract($data);
        $files = str_replace('.', '/', $files);

        require_once __DIR__ . "/../../view/$files.php";
    }
    function redirect ($url){
        header("Location: $url");
        exit;
    }
