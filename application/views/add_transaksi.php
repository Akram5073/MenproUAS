<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">Tambah Transaksi</div>
        <div class="card-body">
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php elseif (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <?= form_open('index.php/add_transaksi'); ?>
            <div class="mb-3">
                <label>Pilih Pelanggan</label>
                <select name="id_pelanggan" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($pelanggan as $p): ?>
                        <option value="<?= $p['id_pelanggan']; ?>"><?= $p['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            

            <div class="mb-3">
                <label>Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control" required>
            </div>

            <label>Detail Item</label>
            <div id="item-container">
                <div class="item-row d-flex gap-2 mb-2">
                    <select name="id_playstation[]" class="form-select" style="flex: 3;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($playstation as $item): ?>
                            <option value="<?= $item['id_playstation']; ?>">
                                <?= $item['kategori']; ?> - Rp <?= $item['harga_sewa']; ?>
                                (Stok: <?= isset($item['stok']) ? $item['stok'] : 'N/A'; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="jumlah_item[]" class="form-control" style="flex: 1;" placeholder="Jumlah"
                        required>
                    <button type="button" class="btn btn-danger btn-remove-item">Hapus</button>
                </div>
            </div>

            <div class="mb-3">
                <label>Jaminan</label>
                <select name="jaminan" class="form-select" required>
                    <option value="">-- Pilih Jaminan --</option>
                    <option value="KTP">KTP</option>
                    <option value="Kartu Pelajar">Kartu Pelajar</option>
                    <option value="Kartu Mahasiswa">Kartu Mahasiswa</option>
                </select>
            </div>

            <button type="button" id="add-item" class="btn btn-secondary mb-3">Tambah Item</button>
            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-item').addEventListener('click', function () {
        const container = document.getElementById('item-container');
        const row = container.querySelector('.item-row').cloneNode(true);
        row.querySelectorAll('input, select').forEach(el => el.value = '');
        row.querySelector('.btn-remove-item').addEventListener('click', () => row.remove());
        container.appendChild(row);
    });

    document.querySelectorAll('.btn-remove-item').forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.item-row').remove();
        });
    });
</script>