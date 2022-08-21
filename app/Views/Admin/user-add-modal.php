<!--  Add Mitra Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title mt-0 text-light" id="addUserModalLabel">Tambah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('/users-save', ['class' => 'addUserForm']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2 col-form-label" for="nip">NIP Pegawai</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Tuliskan NIP 9 digit" />
                        <div class="invalid-feedback errorNip"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2 col-form-label" for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tuliskan nama lengkap pegawai" />
                        <div class="invalid-feedback errorName"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="district_id">Wilayah</label>
                        <select name="district_id" id="district_id" class="form-control">
                            <option value="">--pilih kecamatan--</option>
                            <?php foreach ($district as $dis) : ?>
                                <option value="<?= $dis['district_id']; ?>"><?= str_replace('_', ' ', $dis['district']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback errorDistrictId"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="position_id">Jabatan</label>
                        <select name="position_id" id="position_id" class="form-control">
                            <option value="">--pilih jabatan--</option>
                            <?php foreach ($position as $pos) : ?>
                                <option value="<?= $pos['position_id']; ?>"><?= str_replace('_', ' ', $pos['position']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback errorPositionId"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" />
                        <div class="invalid-feedback errorEmail"></div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="phone">Nomor HP</label>
                        <input type="text" class="form-control" id="phone" name="phone" />
                        <div class="invalid-feedback errorPhone"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">--pilih jenis kelamin--</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-laki">Laki-laki</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="mt-2" for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">--pilih role--</option>
                            <?php foreach ($role as $rol) : ?>
                                <option value="<?= $rol['role_id']; ?>"><?= str_replace('_', ' ', $rol['role']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback errorRoleId"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary saveUserButton">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>



<!-- Add User -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.addUserForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('.saveUserButton').attr('disable', 'disabled');
                    $('.saveUserButton').html('<i class="fa fa-sync fa-spin"></i>');
                },
                complete: function() {
                    $('.saveUserButton').removeAttr('disable');
                    $('.saveUserButton').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nip) {
                            $('#nip').addClass('is-invalid');
                            $('.errorNip').html(response.error.nip);
                        } else {
                            $('#nip').removeClass('is-invalid');
                            $('.errorNip').html('');
                        }
                    }
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
                        if (response.error.district_id) {
                            $('#district_id').addClass('is-invalid');
                            $('.errorDistrictId').html(response.error.district_id);
                        } else {
                            $('#district_id').removeClass('is-invalid');
                            $('.errorDistrictId').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.position_id) {
                            $('#position_id').addClass('is-invalid');
                            $('.errorPositionId').html(response.error.position_id);
                        } else {
                            $('#position_id').removeClass('is-invalid');
                            $('.errorPositionId').html('');
                        }
                    }
                    if (response.error) {
                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.errorEmail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('.errorEmail').html('');
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
                        if (response.error.role_id) {
                            $('#role_id').addClass('is-invalid');
                            $('.errorRoleId').html(response.error.role_id);
                        } else {
                            $('#role_id').removeClass('is-invalid');
                            $('.errorRoleId').html('');
                        }
                    } else {
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