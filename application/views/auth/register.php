<style>
    body {
        background: linear-gradient(to right, #e9f1f7, #cfe9f7);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .register-box {
        max-width: 400px;
        background: #ffffff;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s;
    }

    .register-box:hover {
        transform: translateY(-5px);
    }

    .register-box h3 {
        text-align: center;
        margin-bottom: 30px;
        color: #007bff;
        font-weight: bold;
        font-size: 26px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        display: block;
    }

    .form-control {
        border-radius: 20px;
        border: 1px solid #007bff;
        padding: 10px 15px;
        transition: border-color 0.3s, box-shadow 0.3s;
        width: 100%;
    }

    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 5px rgba(0, 86, 179, 0.5);
        outline: none;
    }

    .btn-primary {
        margin-top: 20px;
        width: 100%;
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        border-radius: 20px;
        padding: 10px;
        transition: background-color 0.3s, transform 0.3s;
        color: #ffffff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .login-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #007bff;
        text-decoration: none;
        font-weight: 600;
    }

    .login-link:hover {
        text-decoration: underline;
    }

    .alert-danger, .alert-success {
        text-align: center;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .alert-danger {
        color: #dc3545;
    }

    .alert-success {
        color: #28a745;
    }
</style>

<div class="register-box">
    <h3>Register Admin</h3>
    <?php if (!empty($error)) echo "<div class='alert-danger'>$error</div>"; ?>
    <?php if (!empty($success)) echo "<div class='alert-success'>$success</div>"; ?>

    <form method="post">
        <label class="form-label" for="nama">Nama</label>
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Enter your name" required>

        <label class="form-label" for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Choose a username" required>

        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>

        <button class="btn-primary" type="submit">Register</button>
        <a href="<?= site_url('index.php/auth/login'); ?>" class="login-link">Login</a>
    </form>
</div>

<script>
function validateRegister() {
    const nama = document.getElementById('nama').value;
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Optional client-side validation
    if (!nama || !username || !password) {
        alert("Please fill in all fields!");
        return false;
    }

    // You could add regex or length checks here
    return true;
}
</script>