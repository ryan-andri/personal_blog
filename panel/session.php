<?php
session_start();
require_once('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');

    $db = dbInstance();
    $db->where("username", $user);
    $data = $db->getOne("admin");

    if ($db->count > 0) {
        $db_pass = $data['hash'];
        if (password_verify($pass, $db_pass)) {
            $_SESSION['admin_loged'] = $data['username'];
            header('location:' . BASE_URL . '/panel');
            exit();
        }
    }
    $_SESSION['failed'] = "Wrong Username or password";
    header('location:' . BASE_URL . '/panel/login.php');
}
