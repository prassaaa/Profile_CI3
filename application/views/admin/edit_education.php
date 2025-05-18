<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Pendidikan</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/update_education/'.$education->id) ?>" method="post">
                        <div class="mb-3">
                            <label for="institution" class="form-label">Institusi</label>
                            <input type="text" class="form-control" id="institution" name="institution" value="<?= $education->institution ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="degree" class="form-label">Gelar/Jenjang</label>
                            <input type="text" class="form-control" id="degree" name="degree" value="<?= $education->degree ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_year" class="form-label">Tahun Mulai</label>
                                    <input type="number" class="form-control" id="start_year" name="start_year" min="1900" max="<?= date('Y') ?>" value="<?= $education->start_year ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_year" class="form-label">Tahun Selesai</label>
                                    <input type="number" class="form-control" id="end_year" name="end_year" min="1900" max="<?= date('Y') + 10 ?>" value="<?= $education->end_year == 0 ? '' : $education->end_year ?>">
                                    <small class="text-muted">Kosongkan jika masih berlangsung</small>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gpa" class="form-label">IPK/Nilai</label>
                            <input type="text" class="form-control" id="gpa" name="gpa" value="<?= $education->gpa ?>">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?= $education->description ?></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/education') ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
