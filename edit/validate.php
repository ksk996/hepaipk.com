<?php
require_once '../modal.php';
$username = $_GET['username'];
$password = $_GET['password'];

$result = [];

$query = ['editor_name' => $username,'editor_pwd' => $password];

$user = $editors_co->findOne($query);
if (!empty($user)) {
    $result = [
        'code' => 0,
        'msg' => 'ok'
    ];
    session_start();
    $_SESSION['user'] = $username;
} else {
    $result = [
        'code' => 500,
        'msg' => '没有此用户'
    ];
}

echo json_encode($result);