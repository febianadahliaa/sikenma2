<?= $this->extend('layouts/layout'); ?>


<?= $this->section('pluginCss'); ?>
<!-- DataTables -->
<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection('pluginCss'); ?>


<?= $this->section('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Daftar Pegawai BPS Kabupaten Wakatobi</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-sm-8">
        <button type="button" class="btn btn-primary btn-sm mb-4 addUserButton">
            <i class="mdi mdi-account-plus mr-2"></i> Tambah Data Pegawai Baru
        </button>

        <div class="card m-b-30">
            <div class="card-body table-responsive-sm">
                <table id="userListData" class="table table-hover table-sm" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($userList as $key) : ?>
                            <tr id="<?= $key['nip']; ?>" data-user-name="<?= $key['name']; ?>">
                                <td class="text-center"><?= $i ?></td>
                                <td><?= $key['nip']; ?></td>
                                <td><?= $key['name']; ?></td>
                                <td><?= $key['role']; ?></td>
                                <td class="action text-center">
                                    <button type="button" class="btn btn-sm btn-info userDetailButton" title="Detail User">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-info" onclick="editUser(<?= $key['nip']; ?>)" title="Edit Data">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning resetPasswordUserButton" title="Reset Password">
                                        <i class="fa fa-unlock-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger deleteUserButton" title="Hapus Data">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="viewUserModal" style="display: none;"></div>
</div>
<?= $this->endSection('content'); ?>


<?= $this->section('pluginJs'); ?>
<!-- Required datatable js -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>
<?= $this->endSection('pluginJs'); ?>


<?= $this->section('appJs'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#userListData').DataTable();
    });
</script>


<script type="text/javascript">
    // View add user modal
    $(document).ready(function() {
        $('.addUserButton').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: '/users-add',
                dataType: 'json',
                success: function(response) {
                    $('.viewUserModal').html(response.dataAddUserForm).show();
                    $('#addUserModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    // View user detail modal
    $('.userDetailButton').on('click', function(event) {
        event.preventDefault();
        var nip = $(this).parents('tr').attr('id');
        $.ajax({
            type: 'get',
            url: `/users-detail/${nip}`,
            dataType: 'json',
            success: function(response) {
                if (response.dataUserDetailForm) {
                    $('.viewUserModal').html(response.dataUserDetailForm).show();
                    $('#userDetailModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    // View edit user modal
    function editUser(nip) {
        $.ajax({
            type: 'get',
            url: `/users-edit/${nip}`,
            dataType: 'json',
            success: function(response) {
                if (response.dataEditUserForm) {
                    $('.viewUserModal').html(response.dataEditUserForm).show();
                    $('#editUserModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Reset password user
    $('.resetPasswordUserButton').on('click', function(event) {
        event.preventDefault();
        var nip = $(this).parents('tr').attr('id');
        var uname = $(this).parents('tr').attr('data-user-name');

        Swal.fire({
            title: 'Reset password',
            text: `Yakin ingin mereset password user ${uname} ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post',
                    url: `/users-reset-password/${nip}`,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.successResetPassword,
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    });

    // Delete user
    $('.deleteUserButton').on('click', function(event) {
        event.preventDefault();
        var nip = $(this).parents('tr').attr('id');
        var uname = $(this).parents('tr').attr('data-user-name');

        Swal.fire({
            title: 'Hapus',
            text: `Yakin ingin menghapus data user ${uname} ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'delete',
                    url: `/users-delete/${nip}`,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: response.successDelete,
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection('appJs'); ?>