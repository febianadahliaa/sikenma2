<!-- Edit Mitra Modal -->
<div class="modal fade" id="editMitraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title mt-0 text-light" id="exampleModalLabel">Edit Data Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/mitra-update', ['class' => 'editMitraForm']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>" />
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2 col-form-label" for="name">Nama Mitra</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>" />
                        <div class="invalid-feedback errorName"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2 col-form-label" for="village_id">Desa Asal</label>
                        <select name="village_id" id="village_id" class="form-control">
                            <?php foreach ($village as $key) : ?>
                                <option value="<?= $key['village_id']; ?>" <?php if ($village_id == $key['village_id']) echo "selected"; ?>><?= str_replace('_', ' ', $key['village']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback errorVillageId"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="birthdate">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= $birthdate; ?>" />
                        <div class="invalid-feedback errorBirthdate"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Perempuan" <?php if ($gender == 'Perempuan') echo "selected"; ?>>Perempuan</option>
                            <option value="Laki-laki" <?php if ($gender == 'Laki-laki') echo "selected"; ?>>Laki-laki</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="phone">Nomor HP</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $phone; ?>" />
                        <div class="invalid-feedback errorPhone"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="marriage">Status Perkawinan</label>
                        <select name="marriage" id="marriage" class="form-control">
                            <option value="">--pilih status perkawinan--</option>
                            <option value="Belum Menikah" <?php if ($marriage == 'Belum Menikah') echo "selected"; ?>>Belum Menikah</option>
                            <option value="Sudah Menikah" <?php if ($marriage == 'Sudah Menikah') echo "selected"; ?>>Sudah Menikah</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="education">Pendidikan Terakhir yang Ditamatkan</label>
                        <select name="education" id="education" class="form-control">
                            <option value="SD/MI" <?php if ($education == 'SD/MI') echo "selected"; ?>>SD/MI</option>
                            <option value="SMP/MTs" <?php if ($education == 'SMP/MTs') echo "selected"; ?>>SMP/MTs</option>
                            <option value="SMA/MA/SMK" <?php if ($education == 'SMA/MA/SMK') echo "selected"; ?>>SMA/MA/SMK</option>
                            <option value="DI" <?php if ($education == 'DI') echo "selected"; ?>>DI</option>
                            <option value="DII" <?php if ($education == 'DII') echo "selected"; ?>>DII</option>
                            <option value="DIII" <?php if ($education == 'DIII') echo "selected"; ?>>DIII</option>
                            <option value="DIV" <?php if ($education == 'DIV') echo "selected"; ?>>DIV</option>
                            <option value="S1" <?php if ($education == 'S1') echo "selected"; ?>>S1</option>
                        </select>
                        <div class="invalid-feedback errorEducation"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="job">Pekerjaan</label>
                        <input type="text" class="form-control" id="job" name="job" value="<?= $job; ?>" />
                        <div class="invalid-feedback errorJob"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info updateMitraButton">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<!-- Edit Mitra -->
<script>
    $(document).ready(function() {
        $('.editMitraForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('.updateMitraButton').attr('disable', 'disabled');
                    $('.updateMitraButton').html('<i class="fa fa-sync fa-spin"></i>');
                },
                complete: function() {
                    $('.updateMitraButton').removeAttr('disable');
                    $('.updateMitraButton').html('Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.name) {
                            $('#name').addClass('is-invalid');
                            $('.errorName').html(response.error.name);
                        } else {
                            $('#name').removeClass('is-invalid');
                            $('.errorName').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.village_id) {
                            $('#village_id').addClass('is-invalid');
                            $('.errorVillageId').html(response.error.village_id);
                        } else {
                            $('#village_id').removeClass('is-invalid');
                            $('.errorVillageId').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.birthdate) {
                            $('#birthdate').addClass('is-invalid');
                            $('.errorBirthdate').html(response.error.birthdate);
                        } else {
                            $('#birthdate').removeClass('is-invalid');
                            $('.errorBirthdate').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.phone) {
                            $('#phone').addClass('is-invalid');
                            $('.errorPhone').html(response.error.phone);
                        } else {
                            $('#phone').removeClass('is-invalid');
                            $('.errorPhone').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.education) {
                            $('#education').addClass('is-invalid');
                            $('.errorEducation').html(response.error.education);
                        } else {
                            $('#education').removeClass('is-invalid');
                            $('.errorEducation').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.job) {
                            $('#job').addClass('is-invalid');
                            $('.errorJob').html(response.error.job);
                        } else {
                            $('#job').removeClass('is-invalid');
                            $('.errorJob').html('');
                        }
                    } else {
                        $('#addMitraModal').modal('hide');
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