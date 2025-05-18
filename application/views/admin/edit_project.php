<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Proyek</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/update_project/'.$project->id) ?>" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <img src="<?= !empty($project->image) ? base_url('assets/uploads/projects/'.$project->image) : base_url('assets/images/project-default.jpg') ?>" class="img-fluid rounded mb-3" alt="<?= $project->title ?>" style="max-height: 200px;">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ubah Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maks: 2MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Proyek</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?= $project->title ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"><?= $project->description ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="technologies" class="form-label">Teknologi (pisahkan dengan koma)</label>
                                    <input type="text" class="form-control" id="technologies" name="technologies" value="<?= $project->technologies ?>" placeholder="PHP, CodeIgniter, MySQL">
                                </div>
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link Proyek</label>
                                    <input type="url" class="form-control" id="link" name="link" value="<?= $project->link ?>" placeholder="https://example.com">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/projects') ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
