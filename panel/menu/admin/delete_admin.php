<?php
session_start();
require_once('../../../config/db.php');
require_once(BASE_PATH . '/panel/common/auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'del-id');
    $user = filter_input(INPUT_POST, 'del-user');

    $db = dbInstance();
    $count = $db->getValue("admin", "count(*)");
    if ($count <= 1) {
        $_SESSION['failed'] = "Needed atleast 1 Admin!";
        header('location:' . BASE_URL . '/panel/menu/admin/admin.php');
        exit();
    }

    if ($_SESSION['admin_loged'] != $user) {
        $_SESSION['failed'] = "You don't have right!";
        header('location:' . BASE_URL . '/panel/menu/admin/admin.php');
        exit();
    }

    $db->where('id', $id);
    if ($db->delete('admin')) {
        header('location:' . BASE_URL . '/panel/logout.php');
        exit();
    }
    $_SESSION['failed'] = "Something wrong!";
    header('location:' . BASE_URL . '/panel/menu/admin/admin.php');
}
