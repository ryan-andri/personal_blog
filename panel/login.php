<?php
session_start();
require_once('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin</title>
    <link href="<?= BASE_URL ?>/css/sbadmin-bootstrap/styles.css" rel="stylesheet" />
    <link href="<?= BASE_URL ?>/css/main.css" rel="stylesheet" />
</head>

<body class="bg-custom-login">
    <?php include_once(BASE_PATH . '/common/alert.php'); ?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="card shadow-lg border-0 rounded-lg">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-light my-2">Admin Panel</h4>
                                </div>
                                <div class="card-body">
                                    <form action="<?= BASE_URL ?>/panel/session.php" method="POST">
                                        <div class="form-floating mb-2">
                                            <input class="form-control" name="username" type="text" placeholder="Username" required="required" />
                                            <label for="inputText">Username</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input class="form-control" name="password" type="password" placeholder="Password" required="required" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                            <input type="submit" class="btn btn-outline-primary form-control" name="submit" value="Login">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="<?= BASE_URL ?>/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>