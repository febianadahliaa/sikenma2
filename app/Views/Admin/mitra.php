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
        <!-- <a href="" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#addMitraModal"><i class="mdi mdi-account-plus mr-2"></i> Tambah Data Mitra Baru</a> -->
        <button type="button" class="btn btn-primary btn-sm mb-4 addMitraButton" id="">
            <i class="mdi mdi-account-plus mr-2"></i> Tambah Data Mitra Baru
        </button>
        <!-- <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg">Large modal</button> -->

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
                            <tr id="<?= $key['mitra_id']; ?>">
                                <td class="text-center"><?= $i ?></td>
                                <td><?= $key['name']; ?></td>
                                <td><?= $key['district']; ?></td>
                                <td><?= date_diff(date_create($key['date_of_birth']), date_create(date("Y-m-d")))->format('%y'); ?></td>
                                <td><?= $key['education']; ?></td>
                                <td class="action text-center">
                                    <a href="" class="badge badge-pill badge-success" data-toggle="modal" data-target="#editMitraModal<?= $key['mitra_id']; ?>">Edit</a>
                                    <a href="<?= base_url('manajemen/mitra_list/deleteMitra/' . $key['mitra_id']); ?>" class="badge badge-pill badge-danger deleteMitra" data-toggle="modal" data-target="#deleteMitraModal<?= $key['mitra_id']; ?>">Hapus</a>
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

<div class="row">
    <!--  Modal content for the above example -->
    <div class="addMitraModal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Large modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>Cras mattis consectetur purus sit amet fermentum.
                        Cras justo odio, dapibus ac facilisis in,
                        egestas eget quam. Morbi leo risus, porta ac
                        consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque
                        nisl consectetur et. Vivamus sagittis lacus vel
                        augue laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur.
                        Praesent commodo cursus magna, vel scelerisque
                        nisl consectetur et. Donec sed odio dui. Donec
                        ullamcorper nulla non metus auctor
                        fringilla.</p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
    $(document).ready(function() {
        $('.addMitraButton').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?php site_url('Admin/mitra/addMitra'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.addMitraModal').html(response.data).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>
<?= $this->endSection('appJs'); ?>