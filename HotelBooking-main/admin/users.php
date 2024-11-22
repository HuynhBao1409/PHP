<?php
require('inc/essentials.php');
require('inc/db_config.php');

session_start();
// Kiểm tra xem admin đã đăng nhập chưa
if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] === true)) {
    redirect("index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý-User</title>
    <?php require('inc/links.php'); ?>
</head>

<script>
    function deleteUser(userId) {
        if(confirm("Bạn có chắc chắn muốn xóa user này không?")) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/users.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if(this.responseText == 'admin') {
                    alert('Không thể xóa tài khoản admin!');
                }
                else if(this.responseText == 1) {
                    alert('Xóa user thành công!');
                    window.location.reload();
                }
                else {
                    alert('Lỗi khi xóa user!');
                }
            }

            xhr.send('delete_user=1&user_id='+userId);
        }
    }

    function editUser(userId) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            let data = JSON.parse(this.responseText);
            document.getElementById('edit-name').value = data.name;
            document.getElementById('edit-email').value = data.email;
            document.getElementById('edit-user-id').value = data.id;
        }

        xhr.send('get_user='+userId);
    }

    let editUserForm = document.getElementById('edit-user-form');
    editUserForm.addEventListener('submit', function(e) {
        e.preventDefault();

        let data = new FormData(this);
        data = new URLSearchParams(data);
        data.append('edit_user', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if(this.responseText == 'email_exists') {
                alert('Email này đã được sử dụng!');
            }
            else if(this.responseText == 1) {
                alert('Cập nhật user thành công!');
                window.location.reload();
            }
            else {
                alert('Lỗi khi cập nhật user!');
            }
        }

        xhr.send(data.toString());
    });
</script>



<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" style="margin-top: 70px;">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">QUẢN LÝ NGƯỜI DÙNG</h3>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-user">
                            <i class="bi bi-plus-square"></i> Thêm Tài khoản
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-hover border">
                            <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $users_sql = "SELECT * FROM `users`";
                            $users_res = selectAll('users');
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($users_res)) {
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm shadow-none me-3" onclick="deleteUser(<?php echo $row['id']; ?>)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#edit-user" onclick="editUser(<?php echo $row['id']; ?>)">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for add user -->
<div class="modal fade" id="add-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Thêm người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên</label>
                        <input type="text" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control shadow-none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for edit user -->
<div class="modal fade" id="edit-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit-user-form">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên</label>
                        <input type="text" name="name" id="edit-name" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control shadow-none" required>
                    </div>
                    <input type="hidden" name="userId" id="edit-user-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php require('inc/scripts.php'); ?>
</body>
</html>