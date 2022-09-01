<!--  Add Survey Master Modal -->
<div class="modal fade" id="addMitraTrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title mt-0 text-light" id="exampleModalLabel">Tambah Data Track Record Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/mitra-tr-save', ['class' => 'addMitraTrForm']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-row">
                    <label class="col-form-label" for="generalInfo">Informasi Mitra dan Kegiatan Statistik</label>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg">
                        <select name="mitraId" id="mitraId" class="form-control">
                            <option value="">--pilih mitra yang akan dinilai--</option>
                            <?php foreach ($mitraList as $key) : ?>
                                <option value="<?= $key['mitra_id']; ?>"><?= $key['name']; ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback errorMitraId"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <select name="surveyId" id="surveyId" class="form-control">
                            <option value="">--pilih kegiatan statistik--</option>
                            <?php foreach ($surveyList as $key) : ?>
                                <option value="<?= $key['survey_id']; ?>"><?= $key['survey_master_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback errorSurveyId"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" id="year" name="year" placeholder="tahun kegiatan" />
                        <div class="invalid-feedback errorYear"></div>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-form-label" for="score">Penilaian (60-95)</label>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" id="geoScore" name="geoScore" placeholder="Nilai penguasaan wilayah" />
                        <div class="invalid-feedback errorGeoScore"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" id="itScore" name="itScore" placeholder="Nilai penguasaan teknologi" />
                        <div class="invalid-feedback errorItScore"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" id="probScore" name="probScore" placeholder="Nilai kemampuan probing" />
                        <div class="invalid-feedback errorProbScore"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" id="qtyScore" name="qtyScore" placeholder="Nilai kualitas isian" />
                        <div class="invalid-feedback errorQtyScore"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" id="abcScore" name="abcScore" placeholder="Nilai kerapihan tulisan" />
                        <div class="invalid-feedback errorAbcScore"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" id="timeScore" name="timeScore" placeholder="Nilai ketepatan waktu" />
                        <div class="invalid-feedback errorTimeScore"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg">
                        <select name="userId" id="userId" class="form-control">
                            <option value="">--pilih pegawai yang menilai mitra--</option>
                            <?php foreach ($usersList as $key) : ?>
                                <option value="<?= $key['nip']; ?>"><?= $key['name']; ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback errorUserId"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary saveMitraTrButton">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<!-- Add Mitra Track Record -->
<script>
    $(document).ready(function() {
        $('.addMitraTrForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('.saveMitraTrButton').attr('disable', 'disabled');
                    $('.saveMitraTrButton').html('<i class="fa fa-sync fa-spin"></i>');
                },
                complete: function() {
                    $('.saveMitraTrButton').removeAttr('disable');
                    $('.saveMitraTrButton').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.mitraId) {
                            $('#mitraId').addClass('is-invalid');
                            $('.errorMitraId').html(response.error.mitraId);
                        } else {
                            $('#mitraId').removeClass('is-invalid');
                            $('.errorMitraId').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.surveyId) {
                            $('#surveyId').addClass('is-invalid');
                            $('.errorSurveyId').html(response.error.surveyId);
                        } else {
                            $('#surveyId').removeClass('is-invalid');
                            $('.errorSurveyId').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.year) {
                            $('#year').addClass('is-invalid');
                            $('.errorYear').html(response.error.year);
                        } else {
                            $('#year').removeClass('is-invalid');
                            $('.errorYear').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.surveyId) {
                            $('#surveyId').addClass('is-invalid');
                            $('.errorSurveyId').html(response.error.surveyId);
                        } else {
                            $('#surveyId').removeClass('is-invalid');
                            $('.errorSurveyId').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.geoScore) {
                            $('#geoScore').addClass('is-invalid');
                            $('.errorGeoScore').html(response.error.geoScore);
                        } else {
                            $('#geoScore').removeClass('is-invalid');
                            $('.errorGeoScore').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.itScore) {
                            $('#itScore').addClass('is-invalid');
                            $('.errorItScore').html(response.error.itScore);
                        } else {
                            $('#itScore').removeClass('is-invalid');
                            $('.errorItScore').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.probScore) {
                            $('#probScore').addClass('is-invalid');
                            $('.errorProbScore').html(response.error.probScore);
                        } else {
                            $('#probScore').removeClass('is-invalid');
                            $('.errorProbScore').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.qtyScore) {
                            $('#qtyScore').addClass('is-invalid');
                            $('.errorQtyScore').html(response.error.qtyScore);
                        } else {
                            $('#qtyScore').removeClass('is-invalid');
                            $('.errorQtyScore').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.abcScore) {
                            $('#abcScore').addClass('is-invalid');
                            $('.errorAbcScore').html(response.error.abcScore);
                        } else {
                            $('#abcScore').removeClass('is-invalid');
                            $('.errorAbcScore').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.timeScore) {
                            $('#timeScore').addClass('is-invalid');
                            $('.errorTimeScore').html(response.error.timeScore);
                        } else {
                            $('#timeScore').removeClass('is-invalid');
                            $('.errorTimeScore').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.userId) {
                            $('#userId').addClass('is-invalid');
                            $('.errorUserId').html(response.error.userId);
                        } else {
                            $('#userId').removeClass('is-invalid');
                            $('.errorUserId').html('');
                        }
                    } else {
                        $('#addSurveyMasterModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.successSave,
                        }).then(function() {
                            location.reload();
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>