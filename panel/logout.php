<?php
require_once('../config/db.php');
session_start();
session_destroy();
header('location:' . BASE_URL . '/panel/login.php');
