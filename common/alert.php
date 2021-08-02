<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            <strong>Success!</strong>. ' . $_SESSION['success'] . '
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['failed'])) {
    echo '<div class="alert alert-warning alert-dismissible fade show m-2" role="alert">
            <strong>Mission failed!</strong>. ' . $_SESSION['failed'] . '
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    unset($_SESSION['failed']);
}
