<?php
if (!isset($_SESSION['admin_loged'])) {
    header('location:' . BASE_URL . '/panel/login.php');
    exit();
}
