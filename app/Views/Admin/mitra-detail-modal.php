<!-- User Detail Modal -->
<div class="modal fade" id="mitraDetailModal" tabindex="-1" role="dialog" aria-labelledby="mitraDetailModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog col-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title h5 text-light" id="mitraDetailModalLabel">Detail Mitra <b><?= $mitraDetail->name; ?></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-id-badge"></i> <?= $mitraDetail->name; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-phone-square"></i> <?= $mitraDetail->phone; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-map-marker"></i> <?= $mitraDetail->village; ?>, <?= $mitraDetail->district; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw  fa fa-calendar-check-o"></i> <?= date_diff(date_create($mitraDetail->date_of_birth), date_create(date("Y-m-d")))->format('%y'); ?> tahun</p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-venus-mars"></i> <?= $mitraDetail->gender; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-ring-diamond"></i> <?= $mitraDetail->marriage_status; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-graduation-cap"></i> <?= $mitraDetail->education; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-briefcase"></i> <?= $mitraDetail->job; ?></p>
            </div>
        </div>
    </div>
</div>