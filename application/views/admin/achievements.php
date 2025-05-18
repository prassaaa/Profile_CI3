<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Kelola Prestasi & Sertifikasi</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addAchievementModal">
                        <i class="fas fa-plus me-1"></i> Tambah Prestasi
                    </button>
                </div>
                <div class="card-body">
                    <?php if(!empty($achievements)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tempat</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($achievements as $achievement): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $achievement->title ?></td>
                                            <td><?= $achievement->place ?></td>
                                            <td><?= $achievement->year ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/edit_achievement/'.$achievement->id) ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" onclick="confirmDelete('<?= base_url('admin/delete_achievement/'.$achievement->id) ?>', '<?= $achievement->title ?>')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Belum ada data prestasi. Silakan tambahkan prestasi baru.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Prestasi -->
<div class="modal fade" id="addAchievementModal" tabindex="-1" aria-labelledby="addAchievementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/add_achievement') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAchievementModalLabel">Tambah Prestasi/Sertifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="place" class="form-label">Tempat</label>
                        <input type="text" class="form-control" id="place" name="place">
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="year" name="year" min="1900" max="<?= date('Y') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
