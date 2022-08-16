<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content'); ?>
<div class="row mt-4">
    <div class="col-lg-6">
        <div class="card m-b-30">
            <h5 class="card-header mt-0 m-0 text-warning text-uppercase">Kegiatan Saat Ini</h5>
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Special title treatment</h4>
                <p class="card-text">With supporting text below as a natural lead-in to
                    additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card m-b-30">
            <h5 class="card-header mt-0 m-0 text-primary text-uppercase">Rekomendasi Mitra</h5>
            <div class="card-body">
                <h4 class="card-title font-20 mt-0">Special title treatment</h4>
                <p class="card-text">With supporting text below as a natural lead-in to
                    additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>