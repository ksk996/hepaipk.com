<?php
require_once '../modal.php';

$username = $_GET['username'];
$password = $_GET['password'];

$user = $editors_co->findOne(['editor_name' => $username]);
if (empty($user)) {
    echo json_encode(['code' => '9999']);
} else {
    $editors_co->updateOne(['editor_name' => $username],['$set' => ['editor_pwd' => $password]]);
    echo json_encode(['code' => '0']);
}
exit();