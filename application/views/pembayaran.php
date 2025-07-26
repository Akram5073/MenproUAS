<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">Add Pembayaran</div>
        <div class="card-body">
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php elseif (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <?= form_open('index.php/pembayaran'); ?>
                <div class="mb-3">
                    <label for="id_transaksi" class="form-label">Transaction ID</label>
                    <select class="form-select" name="id_transaksi" required>
                        <option value="">Select Transaction</option>
                        <?php foreach ($transaksi as $row): ?>
                            <option value="<?= $row['id_transaksi']; ?>" <?= $id_transaksi == $row['id_transaksi'] ? 'selected' : ''; ?>>

                                ID <?= $row['id_transaksi']; ?> - Pelanggan <?= $row['id_pelanggan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_bayar" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" class="form-control" name="tanggal_bayar" value="<?= $tanggal_bayar; ?>" required>

                </div>

                <div class="mb-3">
                    <label for="metode_bayar" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" name="metode_bayar" required>
                        <option value="">Select Payment Method</option>
                        <option value="Cash" <?= $metode_bayar == 'Cash' ? 'selected' : ''; ?>>Cash</option>
                        <option value="Transfer" <?= $metode_bayar == 'Transfer' ? 'selected' : ''; ?>>Transfer</option>
                        <option value="E-Wallet" <?= $metode_bayar == 'E-Wallet' ? 'selected' : ''; ?>>E-Wallet</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Pembayaran</label>
                    <p class="form-control-plaintext">
                        Rp <?= $jumlah_bayar !== '' ? number_format($jumlah_bayar, 0, ',', '.') : '0'; ?>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Denda (Jika Ada)</label>
                    <p class="form-control-plaintext">
                        Rp <?= $denda !== '' ? number_format($denda, 0, ',', '.') : '0'; ?>
                    </p>
                </div>

                <input type="hidden" name="jumlah_bayar" value="<?= $jumlah_bayar; ?>">
                <input type="hidden" name="denda" value="<?= $denda; ?>">

                <button type="submit" name="calculate" value="1" class="btn btn-secondary">Hitung Total</button>
                <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
            <?= form_close(); ?>
        </div>
    </div>
</div>
