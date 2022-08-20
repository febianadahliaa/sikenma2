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
            <h4 class="page-title">Daftar Mitra BPS Kabupaten Wakatobi</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-sm-12">
        <button type="button" class="btn btn-primary btn-sm mb-4 addMitraButton" id="">
            <i class="mdi mdi-account-plus mr-2"></i> Tambah Data Mitra Baru
        </button>

        <div class="card m-b-30">
            <div class="card-body table-responsive-sm">
                <table id="mitraListData" class="table table-hover table-sm" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Kecamatan</th>
                            <th>Umur</th>
                            <th>Pendidikan</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mitraList as $key) : ?>
                            <tr id="<?= $key['mitra_id']; ?>" data-mitra-name="<?= $key['name']; ?>">
                                <td class="text-center"><?= $i ?></td>
                                <td><?= $key['name']; ?></td>
                                <td><?= $key['district']; ?></td>
                                <td><?= date_diff(date_create($key['date_of_birth']), date_create(date("Y-m-d")))->format('%y'); ?></td>
                                <td><?= $key['education']; ?></td>
                                <td class="action text-center">
                                    <button type="button" class="btn btn-sm btn-info" onclick="editMitra(<?= $key['mitra_id']; ?>)" title="Edit Data">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger deleteMitraButton" title="Hapus Data">
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

    <div class="viewMitraModal" style="display: none;"></div>
    <!-- <div class="viewMitraModal" style="display: none;"></div> -->
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
        $('#mitraListData').DataTable();
    });
</script>

<script type="text/javascript">
    // View add mitra modal
    $(document).ready(function() {
        $('.addMitraButton').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: '/mitra-add',
                dataType: 'json',
                success: function(response) {
                    $('.viewMitraModal').html(response.dataAddMitraForm).show();
                    $('#addMitraModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    // View edit mitra modal
    function editMitra(mid) {
        $.ajax({
            type: 'get',
            url: `/mitra-edit/${mid}`,
            // url: '/mitra-edit',
            // data: {
            //     mitra_id: mid
            // },
            dataType: 'json',
            success: function(response) {
                if (response.dataEditMitraForm) {
                    $('.viewMitraModal').html(response.dataEditMitraForm).show();
                    $('#editMitraModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<script>
    // Delete mitra
    $('.deleteMitraButton').on('click', function(event) {
        event.preventDefault();
        var mid = $(this).parents('tr').attr('id');
        var mname = $(this).parents('tr').attr('data-mitra-name');

        Swal.fire({
            title: 'Hapus',
            text: `Yakin ingin menghapus data mitra ${mname} ?`,
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
                    url: `/mitra-delete/${mid}`,
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