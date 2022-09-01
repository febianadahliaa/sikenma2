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
            <h4 class="page-title">Summary Track Record Mitra</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-sm-8">
        <div class="card m-b-30">
            <div class="card-body table-responsive-sm">
                <table id="mitraSummaryListData" class="table table-hover table-sm" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Wilayah</th>
                            <th>Overall Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mitraTrSummary as $key) : ?>
                            <tr id="<?= $key['mitra_id']; ?>">
                                <td class="text-center"><?= $i ?></td>
                                <td><?= $key['name']; ?></td>
                                <td><?= $key['district']; ?></td>

                                <td class="text-center">
                                    <?= round(($key['geo'] * 0.15 + $key['it'] * 0.1 + $key['prob'] * 0.25 + $key['qty'] * 0.2 + $key['abc'] * 0.1 + $key['time'] * 0.2), 2, PHP_ROUND_HALF_UP); ?>
                                    <!-- <?= $mitra_score = ($key['geo'] * 0.15 + $key['it'] * 0.1 + $key['prob'] * 0.25 + $key['qty'] * 0.2 + $key['abc'] * 0.1 + $key['time'] * 0.2); ?>
                                    <?= number_format((float)$mitra_score, 2, '.', ''); ?> -->
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
        $('#mitraSummaryListData').DataTable();
    });
</script>
<?= $this->endSection('appJs'); ?>