<?php
require_once '../vendor/autoload.php';
ini_set('session.gc_maxlifetime', 86400);
session_set_cookie_params(86400);
session_start();
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $uid = $_SESSION['user'];
} else {
    $uid = 'unknown';
}