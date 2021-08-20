<?php
session_start();
require_once('../../config/db.php');
require_once(BASE_PATH . '/panel/common/auth.php');

$db = dbInstance();

// modal add admin
if (isset($_POST['btn-add-save'])) {
    $input = filter_input_array(INPUT_POST);

    // Kill btn-add-save element
    unset($input['btn-add-save']);

    // Insert begin
    $db->where("username", $input['username']);
    $db->getOne("admin");
    if ($db->count > 0) {
        $_SESSION['failed'] = "Username already exist!";
    } else {
        $input['hash'] = password_hash($input['hash'], PASSWORD_DEFAULT);
        $result = $db->insert('admin', $input);
        if ($result) {
            $_SESSION['success'] = "Adding new admin Success!";
        } else {
            $_SESSION['failed'] = "Something wrong!";
        }
    }
}

// modal delete admin
if (isset($_POST['btn-del'])) {
    $id = filter_input(INPUT_POST, 'del-id');
    $user = filter_input(INPUT_POST, 'del-user');

    $count = $db->getValue("admin", "count(*)");
    if ($count <= 1) {
        $_SESSION['failed'] = "Needed atleast 1 Admin!";
    } else if ($_SESSION['admin_loged'] != $user) {
        $_SESSION['failed'] = "You don't have right!";
    } else {
        $db->where('id', $id);
        if ($db->delete('admin')) {
            header('location:' . BASE_URL . '/panel/logout.php');
            exit();
        } else {
            $_SESSION['failed'] = "Something wrong!";
        }
    }
}

// modal update admin
if (isset($_POST['btn-update'])) {
    $db->where('id', filter_input(INPUT_POST, 'update-id'));
    $user = $db->getOne("admin");
    if (!password_verify(filter_input(INPUT_POST, 'old-password'), $user['hash'])) {
        $_SESSION['failed'] = "Wrong Password!";
    } else if ($_SESSION['admin_loged'] != $user['username']) {
        $_SESSION['failed'] = "You don't have right!";
    } else {
        $db->where("username", filter_input(INPUT_POST, 'username'));
        $data = $db->getOne("admin");
        if ($db->count > 0 && ($_SESSION['admin_loged'] != $data['username'])) {
            $_SESSION['failed'] = "Username already exist!";
        } else {
            $inpass = filter_input(INPUT_POST, 'new-password');
            $input = array();
            $input['username'] = filter_input(INPUT_POST, 'username');
            $input['hash'] = password_hash($inpass, PASSWORD_DEFAULT);
            $db->where('id', filter_input(INPUT_POST, 'update-id'));
            if ($db->update('admin', $input)) {
                $_SESSION['success'] = "Admin Updated!";
            } else {
                $_SESSION['failed'] = "Failed to update admin!";
            }
        }
    }
}

$db = dbInstance();
$rows = $db->get('admin');

require_once(BASE_PATH . '/panel/common/header.php');
require_once(BASE_PATH . '/panel/common/navbar.php');
?>

<?php include_once(BASE_PATH . '/common/alert.php'); ?>
<div class="container-fluid p-4">
    <div class="btn-toolbar justify-content-between mb-2">
        <h1>Admin</h1>
        <div class="page-action-links">
            <a data-bs-toggle="modal" data-bs-target="#add-admin" class="btn btn-outline-primary">
                <span class="icon text-white-60">
                    <i class="fas fa-plus"></i>
                </span>
                <span>Add</span>
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-alt me-1"></i>
        </div>
        <div class="card-body">
            <table class="table table-striped row-border nowrap" id="datatablesSimple">
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
                                <a data-bs-toggle="modal" data-bs-target="#confirm-update-<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm m-2">
                                    <i class="fas fa-pencil-alt fa-sm text-white" aria-hidden="true"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#confirm-delete-<?php echo $row['id']; ?>" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash-alt fa-sm text-white" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade mt-5" id="confirm-update-<?php echo $row['id']; ?>" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <form method="POST">
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
                                            <input type="hidden" name="update-id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-outline-primary btn-sm form-control" name="btn-update">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade mt-5" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <form method="POST">
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
                                            <button type="submit" class="btn btn-outline-primary btn-sm form-control" name="btn-del">Delete</button>
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
            <form method="POST">
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
                        <button type="submit" class="btn btn-outline-primary btn-sm form-control" name="btn-add-save">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once(BASE_PATH . '/panel/common/footer.php');
?>