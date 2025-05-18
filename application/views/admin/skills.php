<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Kelola Keahlian</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSkillModal">
                        <i class="fas fa-plus me-1"></i> Tambah Keahlian
                    </button>
                </div>
                <div class="card-body">
                    <?php if(!empty($skills)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Keahlian</th>
                                        <th>Kategori</th>
                                        <th>Persentase</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($skills as $skill): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $skill->name ?></td>
                                            <td><?= $skill->category ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $skill->percentage ?>%;" aria-valuenow="<?= $skill->percentage ?>" aria-valuemin="0" aria-valuemax="100"><?= $skill->percentage ?>%</div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/edit_skill/'.$skill->id) ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" onclick="confirmDelete('<?= base_url('admin/delete_skill/'.$skill->id) ?>', '<?= $skill->name ?>')" class="btn btn-sm btn-danger">
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
                            Belum ada data keahlian. Silakan tambahkan keahlian baru.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Keahlian -->
<div class="modal fade" id="addSkillModal" tabindex="-1" aria-labelledby="addSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/add_skill') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSkillModalLabel">Tambah Keahlian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Keahlian</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select" id="category" name="category">
                            <option value="Bahasa Pemrograman">Bahasa Pemrograman</option>
                            <option value="Framework & Tools">Framework & Tools</option>
                            <option value="Desain">Desain</option>
                            <option value="Bahasa">Bahasa</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="percentage" class="form-label">Persentase Kemampuan: <span id="percentageValue">75%</span></label>
                        <input type="range" class="form-range" id="percentage" name="percentage" min="10" max="100" step="5" value="75">
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

<!-- Script untuk konfirmasi delete dan update persentase -->
<script>
    function confirmDelete(url, name) {
        if (confirm('Apakah Anda yakin ingin menghapus "' + name + '"?')) {
            window.location.href = url;
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Update persentase secara real-time
        const percentageInput = document.getElementById('percentage');
        const percentageValue = document.getElementById('percentageValue');
        
        if (percentageInput && percentageValue) {
            percentageInput.addEventListener('input', function() {
                percentageValue.textContent = this.value + '%';
            });
        }
    });
</script>
