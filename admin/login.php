<?php
session_start();
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username dan password
    $result = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
    } else {
        $error = 'Username atau password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
            width: 360px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #777;
            font-size: 14px;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group i {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #6e8efb;
            font-size: 18px;
        }

        .form-control {
            width: 100%;
            height: 50px;
            padding: 10px 20px 10px 45px;
            border: 2px solid #e1e1e1;
            border-radius: 25px;
            font-size: 16px;
            color: #333;
            outline: none;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #6e8efb;
            box-shadow: 0 0 8px rgba(110, 142, 251, 0.4);
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .btn-login {
            width: 100%;
            height: 50px;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border: none;
            border-radius: 25px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(110, 142, 251, 0.4);
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(110, 142, 251, 0.6);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        .error-message {
            background-color: #ffebee;
            border-left: 4px solid #f44336;
            color: #b71c1c;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            opacity: 0;
            transform: translateY(-10px);
            animation: showError 0.5s forwards;
        }

        @keyframes showError {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .floating-bg span {
            position: absolute;
            display: block;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 4s infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="floating-bg" id="floating-bg"></div>
    
    <div class="container">
        <div class="login-header">
            <h2>Selamat Datang</h2>
            <p>Silakan masukkan kredensial Anda untuk login</p>
        </div>

        <?php if (isset($error)): ?>
        <div class="error-message">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="post" action="login.php" id="login-form">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
            </div>
            
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            
            <button type="submit" class="btn-login" id="login-btn">
                <span>Login</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>
    </div>

    <script>
        // Animasi background floating
        document.addEventListener('DOMContentLoaded', function() {
            const floatingBg = document.getElementById('floating-bg');
            const numberOfElements = 30;
            
            for (let i = 0; i < numberOfElements; i++) {
                const size = Math.random() * 60 + 10;
                const el = document.createElement('span');
                
                el.style.width = `${size}px`;
                el.style.height = `${size}px`;
                el.style.left = `${Math.random() * 100}%`;
                el.style.top = `${Math.random() * 100}%`;
                el.style.animationDuration = `${Math.random() * 10 + 5}s`;
                el.style.animationDelay = `${Math.random() * 5}s`;
                
                floatingBg.appendChild(el);
            }
            
            // Animasi tombol login saat di-hover
            const loginBtn = document.getElementById('login-btn');
            loginBtn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 8px 20px rgba(110, 142, 251, 0.6)';
            });
            
            loginBtn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 5px 15px rgba(110, 142, 251, 0.4)';
            });
            
            // Efek saat tombol diklik
            loginBtn.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(1px)';
            });
            
            loginBtn.addEventListener('mouseup', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            // Efek fokus pada input
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateX(5px)';
                    this.parentElement.style.transition = 'transform 0.3s';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateX(0)';
                });
            });
            
            // Validasi form
            const form = document.getElementById('login-form');
            form.addEventListener('submit', function(e) {
                const username = document.getElementById('username').value.trim();
                const password = document.getElementById('password').value.trim();
                
                if (username === '' || password === '') {
                    e.preventDefault();
                    if (!document.querySelector('.error-message')) {
                        const errorMsg = document.createElement('div');
                        errorMsg.className = 'error-message';
                        errorMsg.innerHTML = '<i class="fas fa-exclamation-circle"></i> Harap isi semua kolom yang diperlukan!';
                        form.insertBefore(errorMsg, form.firstChild);
                    }
                }
            });
        });
    </script>
</body>
</html>