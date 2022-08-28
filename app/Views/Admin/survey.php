<?= $this->extend('layouts/layout'); ?>


<?= $this->section('pluginCss'); ?>
<!-- DataTables -->
<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection('pluginCss'); ?>


<?= $this->section('content'); ?>
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <h5 class="card-header mt-0 m-0 text-primary text-uppercase">Kegiatan Berjalan</h5>

            <div class="col-lg-12 col-sm-12">
                <button type="button" class="btn btn-primary btn-sm mb-3 mt-3 addSurveyButton">
                    <i class="mdi mdi-folder-plus mr-2"></i> Tambah Kegiatan
                </button>
                <div class="card mb-3">
                    <div class="card-body table-responsive-sm">
                        <table id="surveyListData" class="table table-hover table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Kegiatan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($surveyList as $key) : ?>
                                    <tr id="<?= $key['survey_id']; ?>" data-survey-name="<?= $key['survey_master_name']; ?>">
                                        <td class="text-center"><?= $i ?></td>
                                        <td><?= $key['survey_master_name']; ?></td>
                                        <td><?= $key['start_date']; ?></td>
                                        <td><?= $key['finish_date']; ?></td>
                                        <td class="action text-center">
                                            <button type="button" class="btn btn-sm btn-info" onclick="editSurvey(<?= $key['survey_id']; ?>)" title="Edit Data">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger deleteSurveyButton" title="Hapus Data">
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
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card m-b-30">
            <h5 class="card-header mt-0 m-0 text-warning text-uppercase">Master Kegiatan Statistik</h5>

            <div class="col-lg-12 col-sm-12">
                <button type="button" class="btn btn-warning btn-sm mb-3 mt-3 addSurveyMasterButton">
                    <i class="mdi mdi-folder-plus mr-2"></i> Tambah Kegiatan Baru
                </button>
                <div class="card mb-3">
                    <div class="card-body table-responsive-sm">
                        <table id="surveyMasterListData" class="table table-hover table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Kegiatan</th>
                                    <th>GEO</th>
                                    <th>IT</th>
                                    <th>PROB</th>
                                    <th>QTY</th>
                                    <th>ABC</th>
                                    <th>TIME</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($surveyMasterList as $key) : ?>
                                    <tr id="<?= $key['survey_master_id']; ?>" data-surveyMaster-name="<?= $key['survey_master_name']; ?>">
                                        <td class="text-center"><?= $i ?></td>
                                        <td><?= $key['survey_master_name']; ?></td>
                                        <td><?= $key['geo_score']; ?></td>
                                        <td><?= $key['it_score']; ?></td>
                                        <td><?= $key['prob_score']; ?></td>
                                        <td><?= $key['qty_score']; ?></td>
                                        <td><?= $key['abc_score']; ?></td>
                                        <td><?= $key['time_score']; ?></td>
                                        <td class="action text-center">
                                            <button type="button" class="btn btn-sm btn-info" onclick="editSurveyMaster(<?= $key['survey_master_id']; ?>)" title="Edit Data">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger deleteSurveyMasterButton" title="Hapus Data">
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
        </div>
    </div>

    <div class="viewSurveyModal" style="display: none;"></div>
    <div class="viewSurveyMasterModal" style="display: none;"></div>
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
        $('#surveyListData').DataTable();
        $('#surveyMasterListData').DataTable();
    });
</script>

<script type="text/javascript">
    // View add survey modal
    $(document).ready(function() {
        $('.addSurveyButton').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: '/survey-add',
                dataType: 'json',
                success: function(response) {
                    $('.viewSurveyModal').html(response.dataAddSurveyForm).show();
                    $('#addSurveyModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    // View edit survey modal
    function editSurvey(sid) {
        $.ajax({
            type: 'get',
            url: `/survey-edit/${sid}`,
            dataType: 'json',
            success: function(response) {
                if (response.dataEditSurveyForm) {
                    $('.viewSurveyModal').html(response.dataEditSurveyForm).show();
                    $('#editSurveyModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Delete survey
    $('.deleteSurveyButton').on('click', function(event) {
        event.preventDefault();
        var sid = $(this).parents('tr').attr('id');
        var sname = $(this).parents('tr').attr('data-survey-name');

        Swal.fire({
            title: 'Hapus',
            text: `Yakin ingin menghapus data kegiatan ${sname} ?`,
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
                    url: `/survey-delete/${sid}`,
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

<script type="text/javascript">
    // View add master survey modal
    $(document).ready(function() {
        $('.addSurveyMasterButton').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: '/survey-master-add',
                dataType: 'json',
                success: function(response) {
                    $('.viewSurveyMasterModal').html(response.dataAddSurveyMasterForm).show();
                    $('#addSurveyMasterModal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    // View edit survey master modal
    function editSurveyMaster(smid) {
        $.ajax({
            type: 'get',
            url: `/survey-master-edit/${smid}`,
            dataType: 'json',
            success: function(response) {
                if (response.dataEditSurveyMasterForm) {
                    $('.viewSurveyMasterModal').html(response.dataEditSurveyMasterForm).show();
                    $('#editSurveyMasterModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Delete survey master
    $('.deleteSurveyMasterButton').on('click', function(event) {
        event.preventDefault();
        var smid = $(this).parents('tr').attr('id');
        var smname = $(this).parents('tr').attr('data-surveyMaster-name');

        Swal.fire({
            title: 'Hapus',
            text: `Yakin ingin menghapus data master kegiatan ${smname} ?`,
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
                    url: `/survey-master-delete/${smid}`,
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