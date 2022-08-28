<!-- Edit Survey Modal -->
<div class="modal fade" id="editSurveyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg-6">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title mt-0 text-light" id="exampleModalLabel">Edit Data Survey</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/survey-update', ['class' => 'editSurveyForm']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="surveyId" name="surveyId" value="<?= $surveyId; ?>" />

                <div class="form-row">
                    <div class="form-group col-lg">
                        <label class="mt-2 col-form-label" for="surveyMasterId">Nama Kegiatan</label>
                        <select name="surveyMasterId" id="surveyMasterId" class="form-control">
                            <?php foreach ($surveyMasterList as $key) : ?>
                                <option value="<?= $key['survey_master_id']; ?>" <?php if ($surveyMasterId == $key['survey_master_id']) echo "selected"; ?>><?= str_replace('_', ' ', $key['survey_master_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback errorSurveyMasterId"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="startDate">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" value="<?= $startDate; ?>" />
                        <div class="invalid-feedback errorStartDate"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="finishDate">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="finishDate" name="finishDate" value="<?= $finishDate; ?>" />
                        <div class="invalid-feedback errorFinishDate"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info updateSurveyButton">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<!-- Edit Survey -->
<script>
    $(document).ready(function() {
        $('.editSurveyForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('.updateSurveyButton').attr('disable', 'disabled');
                    $('.updateSurveyButton').html('<i class="fa fa-sync fa-spin"></i>');
                },
                complete: function() {
                    $('.updateSurveyButton').removeAttr('disable');
                    $('.updateSurveyButton').html('Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.survey_master_id) {
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
                        $('#editSurveyModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.successUpdate,
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