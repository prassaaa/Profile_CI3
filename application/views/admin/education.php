<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Kelola Pendidikan</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                        <i class="fas fa-plus me-1"></i> Tambah Pendidikan
                    </button>
                </div>
                <div class="card-body">
                    <?php if(!empty($education)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Institusi</th>
                                        <th>Gelar/Jenjang</th>
                                        <th>Tahun</th>
                                        <th>IPK</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($education as $edu): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $edu->institution ?></td>
                                            <td><?= $edu->degree ?></td>
                                            <td><?= $edu->start_year ?> - <?= ($edu->end_year == 0) ? 'Sekarang' : $edu->end_year ?></td>
                                            <td><?= $edu->gpa ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/edit_education/'.$edu->id) ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" onclick="confirmDelete('<?= base_url('admin/delete_education/'.$edu->id) ?>', '<?= $edu->institution ?>')" class="btn btn-sm btn-danger">
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
                            Belum ada data pendidikan. Silakan tambahkan pendidikan baru.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pendidikan -->
<div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/add_education') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEducationModalLabel">Tambah Pendidikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institusi</label>
                        <input type="text" class="form-control" id="institution" name="institution" required>
                    </div>
                    <div class="mb-3">
                        <label for="degree" class="form-label">Gelar/Jenjang</label>
                        <input type="text" class="form-control" id="degree" name="degree">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_year" class="form-label">Tahun Mulai</label>
                                <input type="number" class="form-control" id="start_year" name="start_year" min="1900" max="<?= date('Y') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_year" class="form-label">Tahun Selesai</label>
                                <input type="number" class="form-control" id="end_year" name="end_year" min="1900" max="<?= date('Y') + 10 ?>">
                                <small class="text-muted">Kosongkan jika masih berlangsung</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="gpa" class="form-label">IPK/Nilai</label>
                        <input type="text" class="form-control" id="gpa" name="gpa">
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
