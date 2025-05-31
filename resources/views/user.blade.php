<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyDyhidrate - User Management</title>
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

        .user-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            color: #667eea;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #333;
        }

        .user-id {
            font-size: 12px;
            color: #666;
            margin-top: 2px;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-height {
            background: #e3f2fd;
            color: #1976d2;
        }

        .badge-weight {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        #user-form input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .table-container button, #user-form button {
            cursor: pointer;
            transition: background 0.3s ease;
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
            .table-container {
                font-size: 14px;
            }
            #user-form {
                flex-direction: column;
                gap: 10px;
            }
            #user-form input, #user-form button {
                width: 100%;
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
                        <a href="/dashboard" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link active">
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
        <div class="main-content">
            <div id="user-section">
                <div class="header">
                    <h1>User Management</h1>
                    <p>Kelola data pengguna MyDyhidrate</p>
                </div>
                <div class="user-section">
                    <h2 class="section-title">
                        <i class="fas fa-users"></i>
                        Data Pengguna
                    </h2>
                    <form id="user-form" onsubmit="saveUser(event)" style="margin-bottom:20px; display: flex; gap: 8px; align-items: center;">
                        <input type="hidden" id="edit-index">
                        <input type="text" id="name" placeholder="Nama" required>
                        <input type="text" id="username" placeholder="Username" required>
                        <input type="email" id="email" placeholder="Email" required>
                        <input type="password" id="password" placeholder="Password Baru">
                        <button type="submit" style="padding:8px 16px; background:#667eea; color:white; border:none; border-radius:6px;">Simpan</button>
                        <button type="button" onclick="resetForm()" style="padding:8px 16px; background:#aaa; color:white; border:none; border-radius:6px;">Reset</button>
                    </form>
                    <div class="table-container">
                        <table id="user-table">
                            <thead>
                                <tr>
                                    <th>User Info</th>
                                    <th>Email</th>
                                    <th>BB | TB</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data user akan di-generate oleh JS -->
                            </tbody>
                        </table>
                        <p id="no-data" style="text-align: center; color: #666; display: none;">Belum ada data user.</p>
                    </div>
                </div>
            </div>
        </div>
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
        let users = @json($users);

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

        function renderTable() {
            const tbody = document.querySelector('#user-table tbody');
            const noDataMsg = document.getElementById('no-data');
            tbody.innerHTML = '';
            if (users.length === 0) {
                noDataMsg.style.display = 'block';
            } else {
                noDataMsg.style.display = 'none';
                users.forEach((user, idx) => {
                    tbody.innerHTML += `
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">${getInitials(user.name)}</div>
                                    <div class="user-details">
                                        <div class="user-name">${user.name}</div>
                                        <div class="user-id">Username: ${user.username}</div>
                                    </div>
                                </div>
                            </td>
                            <td>${user.email}</td>
                            <td>
                                <span class="badge badge-weight">${user.berat_badan ? user.berat_badan + 'kg' : '-'}</span>
                                <span class="badge badge-height">${user.tinggi_badan ? user.tinggi_badan + 'cm' : '-'}</span>
                            </td>
                            <td>
                                <button onclick="editUser(${idx})" style="padding:4px 8px; background:#667eea; color:white; border:none; border-radius:4px; margin-right:4px;">Edit</button>
                                <button onclick="deleteUser(${idx})" style="padding:4px 8px; background:#ff6b6b; color:white; border:none; border-radius:4px;">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            }
        }

        function getInitials(name) {
            return name.split(' ').map(n => n[0]).join('').toUpperCase();
        }

        function saveUser(e) {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const editIndex = document.getElementById('edit-index').value;

            if (editIndex === '') {
                // Tambah user
                fetch('/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, username, email, password })
                })
                .then(async res => {
                    const data = await res.json();
                    if (data.error) {
                        showModal('Error', data.message, 'error');
                    } else {
                        users.push(data);
                        renderTable();
                        resetForm();
                        showModal('Sukses', 'User berhasil ditambahkan!', 'success');
                    }
                })
                .catch(() => showModal('Error', 'Gagal menambah user', 'error'));
            } else {
                // Edit user
                const userId = users[editIndex].id;
                fetch(`/users/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, username, email, password })
                })
                .then(async res => {
                    const data = await res.json();
                    if (data.error) {
                        showModal('Error', data.message, 'error');
                    } else {
                        users[editIndex] = data;
                        renderTable();
                        resetForm();
                        showModal('Sukses', 'User berhasil diupdate!', 'success');
                    }
                })
                .catch(() => showModal('Error', 'Gagal mengedit user', 'error'));
            }
        }

        function editUser(idx) {
            const user = users[idx];
            document.getElementById('name').value = user.name;
            document.getElementById('username').value = user.username;
            document.getElementById('email').value = user.email;
            document.getElementById('password').value = '';
            document.getElementById('edit-index').value = idx;
        }

        function deleteUser(idx) {
            showModal('Konfirmasi', 'Yakin ingin menghapus user ini?', 'confirm', () => {
                const userId = users[idx].id;
                fetch(`/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(async res => {
                    const data = await res.json();
                    if (data.error) {
                        showModal('Error', data.message, 'error');
                    } else {
                        users.splice(idx, 1);
                        renderTable();
                        resetForm();
                        showModal('Sukses', 'User berhasil dihapus!', 'success');
                    }
                })
                .catch(() => showModal('Error', 'Terjadi kesalahan saat menghapus user.', 'error'));
            });
        }

        function resetForm() {
            document.getElementById('user-form').reset();
            document.getElementById('edit-index').value = '';
        }

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

        renderTable();
    </script>
</body>
</html>