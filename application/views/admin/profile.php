<!-- application/views/admin/profile.php -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Profil</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/update_profile') ?>" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-4 text-center">
                            <img src="<?= !empty($profile->photo) ? base_url('assets/uploads/' . $profile->photo) : base_url('assets/images/default-profile.jpg') ?>" 
                                class="rounded-circle img-thumbnail mb-3" 
                                alt="Foto Profil" style="width: 200px; height: 200px; object-fit: cover;">
                            <div class="mb-3">
                                <label for="photo" class="form-label">Ubah Foto Profil</label>
                                <input class="form-control" type="file" id="photo" name="photo">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="<?= $profile->name ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul/Posisi</label>
                                        <input type="text" class="form-control" id="title" name="title" 
                                               value="<?= $profile->title ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nim" class="form-label">NIM</label>
                                        <input type="text" class="form-control" id="nim" name="nim" 
                                               value="<?= $profile->nim ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="birthdate" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" 
                                               value="<?= $profile->birthdate ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?= $profile->email ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Telepon</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               value="<?= $profile->phone ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" 
                                               value="<?= $profile->address ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="about_me" class="form-label">Tentang Saya</label>
                                        <textarea class="form-control" id="about_me" name="about_me" rows="5"><?= $profile->about_me ?? '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
