<?php
session_start();
require_once('../../../config/db.php');
require_once(BASE_PATH . '/panel/common/auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_GET, 'admin_id', FILTER_VALIDATE_INT);

    $db = dbInstance();
    $db->where('id', $id);
    $user = $db->getOne("admin");

    $oldpass = filter_input(INPUT_POST, 'old-password');
    if (!password_verify($oldpass, $user['hash'])) {
        $_SESSION['failed'] = "Wrong Password!";
        header('location:' . BASE_URL . '/panel/menu/admin/admin.php');
        exit();
    }

    if ($_SESSION['admin_loged'] != $user['username']) {
        $_SESSION['failed'] = "You don't have right!";
        header('location:' . BASE_URL . '/panel/menu/admin/admin.php');
        exit();
    }

    $inpass = filter_input(INPUT_POST, 'new-password');
    $input = array();
    $input['username'] = filter_input(INPUT_POST, 'username');
    $input['hash'] = password_hash($inpass, PASSWORD_DEFAULT);

    $db->where('id', $id);
    if ($db->update('admin', $input)) {
        $_SESSION['success'] = "Admin Updated!";
    } else {
        $_SESSION['failed'] = "Failed to update admin!";
    }
    header('location:' . BASE_URL . '/panel/menu/admin/admin.php');
    exit();
}
