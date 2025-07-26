<div class="container mt-4">
    <h2>Edit Data Pelanggan</h2>
    <form method="POST" action="<?php echo site_url('index.php/pelanggan/update/'.$pelanggan['id_pelanggan']); ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $pelanggan['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $pelanggan['alamat']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $pelanggan['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="no_telepon" class="form-label">No Telepon</label>
            <input type="text" class="form-control" name="no_telepon" value="<?php echo $pelanggan['no_telepon']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo site_url('index.php/pelanggan'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
