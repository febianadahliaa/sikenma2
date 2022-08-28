<!--  Add Survey Master Modal -->
<div class="modal fade" id="addSurveyMasterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg-6">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title mt-0 text-light" id="exampleModalLabel">Tambah Data Kegiatan Statistik Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/survey-master-save', ['class' => 'addSurveyMasterForm']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-lg">
                        <label class="col-form-label" for="surveyName">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="surveyName" name="surveyName" placeholder="Tuliskan nama kegiatan dengan lengkap" />
                        <div class="invalid-feedback errorSurveyName"></div>
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
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning saveSurveyMasterButton">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<!-- Add Survey Master -->
<script>
    $(document).ready(function() {
        $('.addSurveyMasterForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('.saveSurveyMasterButton').attr('disable', 'disabled');
                    $('.saveSurveyMasterButton').html('<i class="fa fa-sync fa-spin"></i>');
                },
                complete: function() {
                    $('.saveSurveyMasterButton').removeAttr('disable');
                    $('.saveSurveyMasterButton').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.surveyName) {
                            $('#surveyName').addClass('is-invalid');
                            $('.errorSurveyName').html(response.error.surveyName);
                        } else {
                            $('#surveyName').removeClass('is-invalid');
                            $('.errorSurveyName').html('');
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