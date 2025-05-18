<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Keahlian</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/update_skill/'.$skill->id) ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Keahlian</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $skill->name ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select" id="category" name="category">
                                <option value="Bahasa Pemrograman" <?= $skill->category == 'Bahasa Pemrograman' ? 'selected' : '' ?>>Bahasa Pemrograman</option>
                                <option value="Framework & Tools" <?= $skill->category == 'Framework & Tools' ? 'selected' : '' ?>>Framework & Tools</option>
                                <option value="Desain" <?= $skill->category == 'Desain' ? 'selected' : '' ?>>Desain</option>
                                <option value="Bahasa" <?= $skill->category == 'Bahasa' ? 'selected' : '' ?>>Bahasa</option>
                                <option value="Lainnya" <?= $skill->category == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="percentage" class="form-label">Persentase Kemampuan: <span id="percentageValue"><?= $skill->percentage ?>%</span></label>
                            <input type="range" class="form-range" id="percentage" name="percentage" min="10" max="100" step="5" value="<?= $skill->percentage ?>">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/skills') ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
