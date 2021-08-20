<?php
session_start();
require_once('../../config/db.php');
require_once(BASE_PATH . '/panel/common/auth.php');

$db = dbInstance();
$rows = $db->get('blog');

require_once(BASE_PATH . '/panel/common/header.php');
require_once(BASE_PATH . '/panel/common/navbar.php');
?>

<?php include_once(BASE_PATH . '/common/alert.php'); ?>
<div class="container-fluid p-4">
    <div class="btn-toolbar justify-content-between mb-2">
        <h1>Blog</h1>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-blog me-1"></i>
        </div>
        <div class="card-body">
            <table class="table table-striped row-border nowrap" id="datatablesSimple">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th>Title</th>
                        <th width="15%">Date</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($rows as $row) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?= $row['title']; ?></td>
                            <td><?= $row['created']; ?></td>
                            <td class="text-center">
                                <a data-bs-toggle="modal" data-bs-target="#confirm-update-<?php echo $row['id']; ?>" href="#" class="btn btn-secondary btn-sm m-2">
                                    <i class="fas fa-eye fa-sm text-white" aria-hidden="true"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#confirm-update-<?php echo $row['id']; ?>" href="#" class="btn btn-secondary btn-sm m-2">
                                    <i class="fas fa-pencil-alt fa-sm text-white" aria-hidden="true"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#confirm-delete-<?php echo $row['id']; ?>" href="#" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash-alt fa-sm text-white" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once(BASE_PATH . '/panel/common/footer.php');
?>