<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        
        .form-signin {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .form-signin .login-title {
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            color: #3498db;
        }
        
        .form-signin input {
            margin-bottom: 15px;
            border-radius: 10px;
            height: 50px;
        }
        
        .btn-login {
            background-color: #3498db;
            color: white;
            border: none;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 10px;
            transition: all 0.3s;
            height: 50px;
        }
        
        .btn-login:hover {
            background-color: #2c3e50;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .login-icon {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .login-icon i {
            font-size: 60px;
            color: #3498db;
            background-color: rgba(52, 152, 219, 0.1);
            border-radius: 50%;
            width: 100px;
            height: 100px;
            line-height: 100px;
        }
        
        .form-signin .form-floating:focus-within {
            z-index: 2;
        }
        
        .form-signin .form-floating label {
            color: #6c757d;
        }
        
        .form-floating>label {
            padding: 0.9rem 0.75rem;
        }
        
        .alert {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .back-link:hover {
            color: #3498db;
        }
        
        /* Animation for form */
        .form-signin {
            animation: fadeInUp 0.5s ease-in-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 20px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
    </style>
</head>
<body>
    <main class="form-signin">
        <div class="login-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h3 class="login-title">Login Admin</h3>
        
        <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <form action="<?= base_url('auth/login') ?>" method="post">
            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                <label for="username"><i class="fas fa-user me-2"></i>Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-login w-100" type="submit">Login</button>
            </div>
        </form>
        <a href="<?= base_url() ?>" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Halaman Utama
        </a>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alert after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
</body>
</html>
