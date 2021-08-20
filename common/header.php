<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Daily Blog</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/sbadmin-bootstrap/styles.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/main.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL ?>">RA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= CURRENT_PAGE == "simple-blog" ? "active" : "" ?>" aria-current="page" href="<?= BASE_URL ?>">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= CURRENT_PAGE == "about.php" ? "active" : "" ?>" aria-current="page" href="<?= BASE_URL ?>/about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-3">