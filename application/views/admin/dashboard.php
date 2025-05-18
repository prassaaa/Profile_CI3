<!-- Statistics -->
<div class="row">
    <div class="col-md-3">
        <div class="stat-card stat-primary d-flex align-items-center">
            <div class="me-auto">
                <p>Pengunjung</p>
                <h3>100</h3>
            </div>
            <i class="fas fa-users"></i>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-success d-flex align-items-center">
            <div class="me-auto">
                <p>Proyek</p>
                <h3><?= $projects_count ?></h3>
            </div>
            <i class="fas fa-project-diagram"></i>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-warning d-flex align-items-center">
            <div class="me-auto">
                <p>Pesan</p>
                <h3><?= count($messages) ?></h3>
            </div>
            <i class="fas fa-envelope"></i>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-danger d-flex align-items-center">
            <div class="me-auto">
                <p>Keahlian</p>
                <h3><?= $skills_count ?></h3>
            </div>
            <i class="fas fa-code"></i>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pesan Terbaru</h5>
                <a href="<?= base_url('admin/messages') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <?php if(!empty($messages)): ?>
                        <?php foreach($messages as $message): ?>
                            <div class="list-group-item d-flex align-items-center p-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 text-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1"><?= $message->name ?></h6>
                                        <p class="mb-1 text-muted small"><?= substr($message->message, 0, 100) ?><?= strlen($message->message) > 100 ? '...' : '' ?></p>
                                        <small class="text-muted"><?= date('d M Y H:i', strtotime($message->created_at)) ?></small>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <?php if($message->read_status == 0): ?>
                                        <span class="badge bg-danger">Baru</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Dibaca</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="list-group-item p-3 text-center">
                            <p class="mb-0">Belum ada pesan</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Statistik Cepat</h5>
            </div>
            <div class="card-body">
                <canvas id="statChart"></canvas>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Tugas Selanjutnya</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-center py-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="task1">
                            <label class="form-check-label" for="task1">
                                Perbarui foto profil
                            </label>
                        </div>
                        <span class="badge bg-warning ms-auto">Penting</span>
                    </li>
                    <li class="list-group-item d-flex align-items-center py-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="task2">
                            <label class="form-check-label" for="task2">
                                Tambahkan proyek baru
                            </label>
                        </div>
                        <span class="badge bg-info ms-auto">Segera</span>
                    </li>
                    <li class="list-group-item d-flex align-items-center py-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="task3">
                            <label class="form-check-label" for="task3">
                                Perbarui keahlian
                            </label>
                        </div>
                        <span class="badge bg-danger ms-auto">Mendesak</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart for quick stats
    var ctx = document.getElementById('statChart').getContext('2d');
    var statChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pengunjung', 'Proyek', 'Pesan', 'Keahlian'],
            datasets: [{
                data: [100, <?= $projects_count ?>, <?= count($messages) ?>, <?= $skills_count ?>],
                backgroundColor: [
                    '#3498db',
                    '#2ecc71',
                    '#f39c12',
                    '#e74c3c'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
