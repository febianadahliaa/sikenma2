<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content'); ?>
<div class="row mt-4">
    <div class="col-lg-6">
        <div class="card m-b-30">
            <h5 class="card-header mt-0 m-0 text-warning text-uppercase">Kegiatan Saat Ini</h5>
            <div class="card-body">
                <?php foreach ($currentSurveyList as $key) : ?>
                    <div class="h6 mb-0 text-gray-750">
                        <i class="mdi mdi-check-circle mr-1"></i> <?= $key['survey_master_name']; ?>
                    </div>
                    <p class="card-text text-xs text-warning mt-0 mb-3 ml-4"><?= date_format(date_create($key['start_date']), "j M o") . ' sampai ' . date_format(date_create($key['finish_date']), "j M o"); ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card m-b-30">
            <h5 class="card-header mt-0 m-0 text-primary text-uppercase">Rekomendasi Mitra</h5>
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Special title treatment</h4>
                <p class="card-text">頑張ればできるよね.　チャンスがあればやってます。</p>
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>