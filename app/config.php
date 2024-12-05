<?php
    include_once 'util/Utils.php';

    header("X-XSS-Protection: 1; mode=block");

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!defined('DEVELOP_MODE')) define('DEVELOP_MODE','true');

    if (DEVELOP_MODE) {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    }else{
        ini_set('display_errors', '0');
    }

    if (!defined('BASE_PATH')) define('BASE_PATH',(strpos(getenv("HTTP_USER_AGENT"), "Win") !== FALSE)?"http://localhost/iLib/":"http://localhost:8888/iLib/");
    
    if (!defined('VIEWS_PATH')) define('VIEWS_PATH', __DIR__ . "/../views");