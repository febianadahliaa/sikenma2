<!-- User Detail Modal -->
<div class="modal fade" id="userDetailModal" tabindex="-1" role="dialog" aria-labelledby="userDetailModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog col-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title h5 text-light" id="userDetailModalLabel">Detail Pegawai <b><?= $userDetail->name; ?></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-id-badge"></i> <?= $userDetail->nip; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-envelope"></i> <?= $userDetail->email; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-phone-square"></i> <?= $userDetail->phone; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-rocket"></i> <?= $userDetail->position; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-user-o"></i> <?= $userDetail->role; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-venus-mars"></i> <?= $userDetail->gender; ?></p>
                <p class="card-text h5 mb-3"><i class="fa fa-fw fa-map-marker"></i> <?= $userDetail->district; ?></p>
            </div>
        </div>
    </div>
</div>