<?php
session_start();
require_once('../../../config/db.php');

$db = dbInstance();
$rows = $db->get('admin');

require_once(BASE_PATH . '/panel/common/header.php');
require_once(BASE_PATH . '/panel/common/navbar.php');
?>

<?php include_once(BASE_PATH . '/common/alert.php'); ?>
<div class="container-fluid p-4">
    <div class="btn-toolbar justify-content-between">
        <h1>Admin</h1>
        <div class="page-action-links">
            <a data-bs-toggle="modal" data-bs-target="#add-admin" href="#" class="btn btn-outline-primary">
                <span class="icon text-white-60">
                    <i class="fas fa-plus"></i>
                </span>
                <span>Add</span>
            </a>
        </div>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/panel">Dashboard</a></li>
        <li class="breadcrumb-item active">Admin</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users me-1"></i>
        </div>
        <div class="card-body">
            <table class="table table-striped nowrap" id="datatablesSimple">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th>Username</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($rows as $row) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td class="text-center">
                                <a data-bs-toggle="modal" data-bs-target="#confirm-update-<?php echo $row['id']; ?>" href="#" class="btn btn-secondary btn-sm m-2">
                                    <i class="fas fa-pencil-alt fa-sm text-white" aria-hidden="true"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#confirm-delete-<?php echo $row['id']; ?>" href="#" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash-alt fa-sm text-white" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade mt-5" id="confirm-update-<?php echo $row['id']; ?>" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <form action="edit_admin.php?admin_id=<?php echo $row['id']; ?>" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Admin</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-sm-12 p-0 mb-2">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input class="form-control" name="username" type="text" placeholder="Username" required="required" value="<?php echo $row['username']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 p-0 mb-2">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input class="form-control" name="old-password" type="password" placeholder="Old Password" required="required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 p-0">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input class="form-control" name="new-password" type="password" placeholder="New Password" required="required">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-primary btn-sm form-control">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade mt-5" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <form action="delete_admin.php" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Admin</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="del-user" value="<?php echo $row['username']; ?>">
                                            <input type="hidden" name="del-id" value="<?php echo $row['id']; ?>">
                                            <p>Delete Admin -> <b><?php echo $row['username']; ?></b></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-primary btn-sm form-control">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade mt-5" id="add-admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form action="add_admin.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Admin</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-12 p-0 mb-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" name="username" type="text" placeholder="Username" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 p-0 mb-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" name="hash" type="password" placeholder="Password" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm form-control" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm form-control">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once(BASE_PATH . '/panel/common/footer.php');
?>