<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e8f5e9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { width: 100%; max-width: 400px; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; text-align: center; margin-bottom: 20px; font-size: 24px; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .btn { width: 100%; padding: 10px; background: #2c662d; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 20px; }
        .error { color: #dc3545; font-size: 12px; margin-top: 5px; }
        .back { text-align: center; margin-top: 15px; }
        .back a { color: #555; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Admin</h1>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <label>Username</label>
            <input type="text" name="email" value="{{ old('email') }}" required>
            @error('email')<div class="error">{{ $message }}</div>@enderror

            <label>Password</label>
            <input type="password" name="password" required>
            @error('password')<div class="error">{{ $message }}</div>@enderror

            <button type="submit" class="btn">Login</button>
        </form>
        <div class="back">
            <a href="{{ route('transactions.index') }}">← Kembali ke Dashboard Warga</a>
        </div>
    </div>
</body>
</html>
