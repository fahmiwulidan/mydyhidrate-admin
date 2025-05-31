<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyDyhidrate - Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            padding: 20px 0;
            position: relative;
        }

        .logo {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 20px;
        }

        .logo h2 {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .logo p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            margin-top: 5px;
        }

        .nav-menu {
            list-style: none;
            padding: 0 20px;
        }

        .nav-item {
            margin-bottom: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(5px);
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        .logout-section {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 20px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #ff6b6b;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .logout-btn:hover {
            background: rgba(255, 107, 107, 0.1);
            transform: translateX(5px);
        }

        .logout-btn i {
            margin-right: 10px;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .user-icon {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .new-user-icon {
            background: linear-gradient(135deg, #4CAF50, #45a049);
        }

        .session-icon {
            background: linear-gradient(135deg, #FF9800, #F57C00);
        }

        .card-value {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-description {
            color: #666;
            font-size: 14px;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal {
            background: white;
            border-radius: 15px;
            padding: 20px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease;
        }

        .modal h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .modal p {
            color: #666;
            margin-bottom: 20px;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .modal-buttons button {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .modal-confirm {
            background: #667eea;
            color: white;
        }

        .modal-cancel {
            background: #aaa;
            color: white;
        }

        .modal-error {
            background: #ff6b6b;
            color: white;
        }

        .modal-success {
            background: #4caf50;
            color: white;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .logout-section {
                position: relative;
                bottom: auto;
                margin-top: 20px;
            }
            .main-content {
                padding: 20px;
            }
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>MyDyhidrate</h2>
                <p>Admin Dashboard</p>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/users" class="nav-link">
                            <i class="fas fa-users"></i>
                            User Management
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="logout-section">
                <a href="/logout" class="logout-btn" onclick="showLogoutConfirm(event)">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </aside>
        <main class="main-content">
            <div id="dashboard-section">
                <div class="header">
                    <h1>Dashboard Overview</h1>
                    <p>Selamat datang di panel admin MyDyhidrate</p>
                </div>
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Total Users</div>
                            <div class="card-icon user-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="card-value" id="total-users">0</div>
                        <div class="card-description">Pengguna aktif terdaftar</div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">New Users Today</div>
                            <div class="card-icon new-user-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>
                        <div class="card-value" id="new-users-today">0</div>
                        <div class="card-description">Pengguna baru hari ini</div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Active Sessions</div>
                            <div class="card-icon session-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="card-value" id="active-sessions">0</div>
                        <div class="card-description">Sesi aktif saat ini</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal">
            <h3 id="modal-title">Perhatian</h3>
            <p id="modal-message">Pesan akan muncul di sini.</p>
            <div class="modal-buttons">
                <button id="modal-confirm" class="modal-confirm">OK</button>
                <button id="modal-cancel" class="modal-cancel" style="display: none;">Batal</button>
            </div>
        </div>
    </div>
    <script>
        function showModal(title, message, type = 'info', onConfirm = null) {
            const modalOverlay = document.getElementById('modal-overlay');
            const modalTitle = document.getElementById('modal-title');
            const modalMessage = document.getElementById('modal-message');
            const confirmBtn = document.getElementById('modal-confirm');
            const cancelBtn = document.getElementById('modal-cancel');

            modalTitle.textContent = title;
            modalMessage.textContent = message;

            confirmBtn.classList.remove('modal-confirm', 'modal-error', 'modal-success');
            if (type === 'error') {
                confirmBtn.classList.add('modal-error');
            } else if (type === 'success') {
                confirmBtn.classList.add('modal-success');
            } else {
                confirmBtn.classList.add('modal-confirm');
            }

            if (type === 'confirm') {
                cancelBtn.style.display = 'inline-block';
                confirmBtn.textContent = 'Ya';
            } else {
                cancelBtn.style.display = 'none';
                confirmBtn.textContent = 'OK';
            }

            modalOverlay.style.display = 'flex';

            confirmBtn.onclick = () => {
                modalOverlay.style.display = 'none';
                if (onConfirm) onConfirm();
            };

            cancelBtn.onclick = () => {
                modalOverlay.style.display = 'none';
            };
        }

        window.onload = function() {
    fetch('/users/count')
        .then(res => res.json())
        .then(data => {
            document.getElementById('total-users').innerText = data.count ?? 0;
        });

    fetch('/users/today')
        .then(res => res.json())
        .then(data => {
            document.getElementById('new-users-today').innerText = data.count ?? 0;
        });

    fetch('/users/active-sessions')
        .then(res => res.json())
        .then(data => {
            document.getElementById('active-sessions').innerText = data.count ?? 0;
        });
};


        function showLogoutConfirm(event) {
            event.preventDefault();
            showModal('Konfirmasi', 'Apakah Anda yakin ingin logout?', 'confirm', () => {
                fetch('/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (res.status === 419) {
                        throw new Error('Sesi telah kedaluwarsa. Silakan refresh halaman.');
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.href = '/login'; // arahkan ke halaman login
                    } else {
                        showModal('Error', 'Gagal logout', 'error');
                    }
                })
                .catch(err => {
                    showModal('Error', err.message || 'Gagal logout', 'error');
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchDashboardData();
        });
    </script>
</body>
</html>