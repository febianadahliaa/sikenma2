<!--  Add Survey Modal -->
<div class="modal fade" id="addSurveyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg-6">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title mt-0 text-light" id="exampleModalLabel">Tambah Data Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/survey-save', ['class' => 'addSurveyForm']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-lg">
                        <label class="mt-2 col-form-label" for="surveyMasterId">Nama Kegiatan</label>
                        <select name="surveyMasterId" id="surveyMasterId" class="form-control">
                            <option value="">--pilih kegiatan--</option>
                            <?php foreach ($surveyMasterList as $key) : ?>
                                <option value="<?= $key['survey_master_id']; ?>"><?= str_replace('_', ' ', $key['survey_master_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback errorSurveyMasterId"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="startDate">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" />
                        <div class="invalid-feedback errorStartDate"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="finishDate">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="finishDate" name="finishDate" />
                        <div class="invalid-feedback errorFinishDate"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary saveSurveyButton">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<!-- Add Survey -->
<script>
    $(document).ready(function() {
        $('.addSurveyForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('.saveSurveyButton').attr('disable', 'disabled');
                    $('.saveSurveyButton').html('<i class="fa fa-sync fa-spin"></i>');
                },
                complete: function() {
                    $('.saveSurveyButton').removeAttr('disable');
                    $('.saveSurveyButton').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.surveyMasterId) {
                            $('#surveyMasterId').addClass('is-invalid');
                            $('.errorSurveyMasterId').html(response.error.surveyMasterId);
                        } else {
                            $('#surveyMasterId').removeClass('is-invalid');
                            $('.errorSurveyMasterId').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.startDate) {
                            $('#startDate').addClass('is-invalid');
                            $('.errorStartDate').html(response.error.startDate);
                        } else {
                            $('#startDate').removeClass('is-invalid');
                            $('.errorStartDate').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.finishDate) {
                            $('#finishDate').addClass('is-invalid');
                            $('.errorFinishDate').html(response.error.finishDate);
                        } else {
                            $('#finishDate').removeClass('is-invalid');
                            $('.errorFinishDate').html('');
                        }
                    } else {
                        $('#addSurveyModal').modal('hide');
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