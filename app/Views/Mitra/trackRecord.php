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
            <h4 class="page-title">Input Track Record Mitra</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-sm-12">
        <button type="button" class="btn btn-primary btn-sm mb-4 addMitraTrButton" id="">
            <i class="mdi mdi-account-plus mr-2"></i> Tambah Data Track Record Mitra
        </button>

        <div class="card m-b-30">
            <div class="card-body table-responsive-sm">
                <table id="mitraTrListData" class="table table-hover table-sm" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Kegiatan</th>
                            <th>GEO</th>
                            <th>IT</th>
                            <th>PROB</th>
                            <th>QTY</th>
                            <th>ABC</th>
                            <th>TIME</th>
                            <th>Penilai</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mitraTrList as $key) : ?>
                            <tr id="<?= $key['track_record_id']; ?>" data-mitra-name="<?= $key['name']; ?>" data-mitra-survey="<?= $key['survey']; ?>" data-mitra-year="<?= $key['year']; ?>">
                                <td class="text-center"><?= $i ?></td>
                                <td><?= $key['name']; ?></td>
                                <td><?= $key['survey'] . ' ' . $key['year']; ?></td>
                                <td class="text-center"><?= $key['geo_score']; ?></td>
                                <td class="text-center"><?= $key['it_score']; ?></td>
                                <td class="text-center"><?= $key['prob_score']; ?></td>
                                <td class="text-center"><?= $key['qty_score']; ?></td>
                                <td class="text-center"><?= $key['abc_score']; ?></td>
                                <td class="text-center"><?= $key['time_score']; ?></td>
                                <td><?= $key['username']; ?></td>
                                <td class="action text-center">
                                    <button type="button" class="btn btn-sm btn-info" onclick="editMitraTr(<?= $key['track_record_id']; ?>)" title="Edit Data">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger deleteMitraTrButton" title="Hapus Data">
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

    <div class="viewMitraTrModal" style="display: none;"></div>
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
        $('#mitraTrListData').DataTable();
    });
</script>

<script type="text/javascript">
    // View add mitra track record modal
    $(document).ready(function() {
        $('.addMitraTrButton').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: '/mitra-tr-add',
                dataType: 'json',
                success: function(response) {
                    $('.viewMitraTrModal').html(response.dataAddMitraTrForm).show();
                    $('#addMitraTrModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    // View edit mitra track record modal
    function editMitraTr(mtrid) {
        $.ajax({
            type: 'get',
            url: `/mitra-tr-edit/${mtrid}`,
            dataType: 'json',
            success: function(response) {
                if (response.dataEditMitraTrForm) {
                    $('.viewMitraTrModal').html(response.dataEditMitraTrForm).show();
                    $('#editMitraTrModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // alert('hai');
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Delete mitra track record
    $('.deleteMitraTrButton').on('click', function(event) {
        event.preventDefault();
        var mtrid = $(this).parents('tr').attr('id');
        var mtrname = $(this).parents('tr').attr('data-mitra-name');
        var mtrsurvey = $(this).parents('tr').attr('data-mitra-survey');
        var mtryear = $(this).parents('tr').attr('data-mitra-year');

        Swal.fire({
            title: 'Hapus',
            text: `Yakin ingin menghapus track record mitra ${mtrname} pada kegiatan ${mtrsurvey} tahun ${mtryear} ?`,
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
                    url: `/mitra-tr-delete/${mtrid}`,
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