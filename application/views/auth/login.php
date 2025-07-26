<div class="container mt-5">
    <h3>Login Admin</h3>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button  class="btn btn-primary">Login</button>
        <a href="<?= site_url('index.php/auth/register'); ?>">Register</a>
    </form>
</div>
