<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - MyDyhidrate</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #fff;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .avatar {
            background: linear-gradient(to right, #00f2fe, #4facfe);
            width: 70px;
            height: 70px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        p {
            font-size: 14px;
            color: #666;
            margin-bottom: 1.5rem;
        }

        /* Perbaiki CSS ini jika perlu, karena input type sudah diganti */
        input[type="email"], /* <<< GANTI DARI type="username" */
        input[type="password"] {
            width: 88%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 14px;
        }

        button {
            width: 95%;
            padding: 0.8rem;
            border: none;
            border-radius: 10px;
            background: linear-gradient(to right, #00f2fe, #4facfe);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="avatar">🩺</div>
        <h2>MyDyhidrate</h2>

        @if (session('error'))
            <p style="color:red">{{ session('error') }}</p>
        @endif

        <form method="POST" action="/login">
            @csrf
            <p>Admin Dashboard - Pengingat Minum Obat</p>
            <input type="email" name="email" placeholder="Masukkan Email Admin" required> <input type="password" name="password" placeholder="Masukkan Password" required>
            <button type="submit">Masuk Dashboard</button>
        </form>
    </div>
</body>
</html>