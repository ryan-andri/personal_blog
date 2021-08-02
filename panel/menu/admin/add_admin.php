<?php
session_start();
require_once('../../../config/db.php');
require_once(BASE_PATH . '/panel/common/auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = filter_input_array(INPUT_POST);

    $db = dbInstance();
    $db->where("username", $input['username']);
    $db->getOne("admin");
    if ($db->count > 0) {
        $_SESSION['failed'] = "Username already exist!";
        header('location:' . BASE_URL . '/panel/menu/admin/admin.php');
        exit();
    }

    $input['hash'] = password_hash($input['hash'], PASSWORD_DEFAULT);
    $result = $db->insert('admin', $input);
    if ($result) {
        $_SESSION['success'] = "Adding new admin Success!";
    } else {
        $_SESSION['failed'] = "Something wrong!";
    }
    header('location:' . BASE_URL . '/panel/menu/admin/admin.php');
}
