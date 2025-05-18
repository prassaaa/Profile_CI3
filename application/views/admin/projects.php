<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Kelola Proyek</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                        <i class="fas fa-plus me-1"></i> Tambah Proyek
                    </button>
                </div>
                <div class="card-body">
                    <?php if(!empty($projects)): ?>
                        <div class="row">
                            <?php foreach($projects as $project): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <img src="<?= !empty($project->image) ? base_url('assets/uploads/projects/'.$project->image) : base_url('assets/images/project-default.jpg') ?>" class="card-img-top" alt="<?= $project->title ?>" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $project->title ?></h5>
                                            <p class="card-text"><?= substr($project->description, 0, 100) ?><?= strlen($project->description) > 100 ? '...' : '' ?></p>
                                            <?php if(!empty($project->technologies)): ?>
                                                <div class="mb-2">
                                                    <?php foreach(explode(',', $project->technologies) as $tech): ?>
                                                        <span class="badge bg-primary me-1"><?= trim($tech) ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-footer bg-white">
                                            <div class="d-flex justify-content-between">
                                                <a href="<?= base_url('admin/edit_project/'.$project->id) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="#" onclick="confirmDelete('<?= base_url('admin/delete_project/'.$project->id) ?>', '<?= $project->title ?>')" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                                <?php if(!empty($project->link)): ?>
                                                    <a href="<?= $project->link ?>" class="btn btn-primary btn-sm" target="_blank">
                                                        <i class="fas fa-external-link-alt"></i> Demo
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Belum ada data proyek. Silakan tambahkan proyek baru.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Proyek -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/add_project') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">Tambah Proyek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Proyek</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="technologies" class="form-label">Teknologi (pisahkan dengan koma)</label>
                        <input type="text" class="form-control" id="technologies" name="technologies" placeholder="PHP, CodeIgniter, MySQL">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link Proyek</label>
                        <input type="url" class="form-control" id="link" name="link" placeholder="https://example.com">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Proyek</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maks: 2MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk konfirmasi delete -->
<script>
    function confirmDelete(url, name) {
        if (confirm('Apakah Anda yakin ingin menghapus "' + name + '"?')) {
            window.location.href = url;
        }
    }
</script>
