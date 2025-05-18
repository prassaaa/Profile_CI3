<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $profile->name ?? 'Profil Mahasiswa' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        
        .profile-img {
            border-radius: 50%;
            border: 5px solid white;
            width: 200px;
            height: 200px;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .section {
            padding: 80px 0;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            font-weight: 700;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 50px;
            height: 3px;
            background-color: var(--accent-color);
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .skill-bar {
            height: 10px;
            border-radius: 5px;
            background-color: #e9ecef;
            margin-bottom: 20px;
        }
        
        .skill-progress {
            height: 100%;
            border-radius: 5px;
            background-color: var(--primary-color);
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 2px;
            height: 100%;
            background-color: #e9ecef;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        
        .timeline-item:before {
            content: '';
            position: absolute;
            left: -38px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: var(--primary-color);
            border: 4px solid white;
            box-shadow: 0 0 0 2px var(--primary-color);
        }
        
        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 40px 0;
        }
        
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-custom:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        /* Alert styles */
        .alert-float {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 350px;
        }
    </style>
</head>
<body>
    <!-- Flash Messages -->
    <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-float">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-float">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#"><?= $profile->name ?? 'Profil Mahasiswa' ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#education">Pendidikan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#skills">Keahlian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container text-center">
            <img src="<?= !empty($profile->photo) ? base_url('assets/uploads/'.$profile->photo) : base_url('assets/images/default-profile.jpg') ?>" alt="Foto Profil" class="profile-img mb-4">
            <h1 class="display-4 fw-bold"><?= $profile->name ?? 'Nama Mahasiswa' ?></h1>
            <p class="lead"><?= $profile->title ?? 'Mahasiswa Jurusan Teknik Informatika' ?></p>
            <div class="d-flex justify-content-center mt-4">
                <a href="#contact" class="btn btn-custom me-3">Hubungi Saya</a>
                <a href="#projects" class="btn btn-outline-light">Lihat Portofolio</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="section-title">Tentang Saya</h2>
                    <p><?= $profile->about_me ?? 'Saya adalah mahasiswa Teknik Informatika yang bersemangat tentang pengembangan web dan pemrograman.' ?></p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Nama:</strong> <?= $profile->name ?? 'Nama Lengkap' ?></li>
                                <li class="mb-2"><strong>Tanggal Lahir:</strong> <?= !empty($profile->birthdate) ? date('d F Y', strtotime($profile->birthdate)) : '1 Januari 2000' ?></li>
                                <li class="mb-2"><strong>Telepon:</strong> <?= $profile->phone ?? '+62 812 3456 7890' ?></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>NIM:</strong> <?= $profile->nim ?? '12345678' ?></li>
                                <li class="mb-2"><strong>Email:</strong> <?= $profile->email ?? 'email@example.com' ?></li>
                                <li class="mb-2"><strong>Alamat:</strong> <?= $profile->address ?? 'Kediri, Jawa Timur' ?></li>
                            </ul>
                        </div>
                    </div>
                    <a href="#" class="btn btn-custom mt-4">Download CV</a>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Prestasi & Sertifikasi</h3>
                            <div class="timeline">
                                <?php if (!empty($achievements)): ?>
                                    <?php foreach ($achievements as $achievement): ?>
                                        <div class="timeline-item">
                                            <h5><?= $achievement->title ?></h5>
                                            <p class="text-muted"><?= $achievement->place ?>, <?= $achievement->year ?></p>
                                            <p><?= $achievement->description ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="timeline-item">
                                        <h5>Belum ada prestasi atau sertifikasi</h5>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Pendidikan</h2>
            <div class="row g-4 justify-content-center">
                <?php if (!empty($education)): ?>
                    <?php foreach ($education as $edu): ?>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                                    </div>
                                    <h4><?= $edu->degree ?></h4>
                                    <p class="text-muted"><?= $edu->institution ?></p>
                                    <p><?= $edu->start_year ?> - <?= $edu->end_year == 0 ? 'Sekarang' : $edu->end_year ?></p>
                                    <?php if (!empty($edu->gpa)): ?>
                                        <p>IPK: <?= $edu->gpa ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($edu->description)): ?>
                                        <p class="mt-2"><?= $edu->description ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <p>Belum ada data pendidikan</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section">
        <div class="container">
            <h2 class="section-title text-center">Keahlian</h2>
            <div class="row">
                <?php if (!empty($skills)): ?>
                    <?php foreach ($skills as $category => $skill_list): ?>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title mb-4"><?= ucfirst($category) ?></h4>
                                    
                                    <?php foreach ($skill_list as $skill): ?>
                                        <div>
                                            <div class="d-flex justify-content-between mb-1">
                                                <span><?= $skill->name ?></span>
                                                <span><?= $skill->percentage ?>%</span>
                                            </div>
                                            <div class="skill-bar">
                                                <div class="skill-progress" style="width: <?= $skill->percentage ?>%"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-body text-center">
                                <p>Belum ada data keahlian</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Proyek</h2>
            <div class="row g-4">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <img src="<?= !empty($project->image) ? base_url('assets/uploads/projects/'.$project->image) : base_url('assets/images/project-default.jpg') ?>" class="card-img-top" alt="<?= $project->title ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $project->title ?></h5>
                                    <p class="card-text"><?= $project->description ?></p>
                                    <?php if (!empty($project->technologies)): ?>
                                        <div class="mt-3">
                                            <?php foreach (explode(',', $project->technologies) as $tech): ?>
                                                <span class="badge bg-primary me-1"><?= trim($tech) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <?php if (!empty($project->link)): ?>
                                        <a href="<?= $project->link ?>" class="btn btn-sm btn-outline-primary" target="_blank">Lihat Detail</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-body text-center">
                                <p>Belum ada data proyek</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <h2 class="section-title text-center">Kontak Saya</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('home/send_message') ?>" method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required>
                                            <label for="name">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subjek" required>
                                            <label for="subject">Subjek</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="message" name="message" placeholder="Pesan" style="height: 150px" required></textarea>
                                            <label for="message">Pesan</label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-custom px-5">Kirim Pesan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 text-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                            <h4>Alamat</h4>
                            <p><?= $profile->address ?? 'Jl. Contoh No. 123, Kediri, Jawa Timur' ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                            <h4>Telepon</h4>
                            <p><?= $profile->phone ?? '+62 812 3456 7890' ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                            <h4>Email</h4>
                            <p><?= $profile->email ?? 'email@example.com' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <h4 class="mb-4"><?= $profile->name ?? 'Nama Mahasiswa' ?></h4>
            <div class="social-links mb-4">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>
            <p>&copy; <?= date('Y') ?> <?= $profile->name ?? 'Nama Mahasiswa' ?>. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide flash messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert-float');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
</body>
</html>
