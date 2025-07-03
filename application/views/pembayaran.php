<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">Add Pembayaran</div>
        <div class="card-body">
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php elseif (isset($error)): ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <?= form_open('pembayaran'); ?>
                <div class="mb-3">
                    <label for="id_transaksi" class="form-label">Transaction ID</label>
                    <select class="form-select" name="id_transaksi" required>
                        <option value="">Select Transaction</option>
                        <?php foreach ($transaksi as $row): ?>
                            <option value="<?= $row['id_transaksi']; ?>" <?= set_select('id_transaksi', $row['id_transaksi']); ?>>
                                ID <?= $row['id_transaksi']; ?> - Pelanggan <?= $row['id_pelanggan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_bayar" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" class="form-control" name="tanggal_bayar" value="<?= set_value('tanggal_bayar'); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="metode_bayar" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" name="metode_bayar" required>
                        <option value="">Select Payment Method</option>
                        <option value="Cash" <?= set_select('metode_bayar', 'Cash'); ?>>Cash</option>
                        <option value="Transfer" <?= set_select('metode_bayar', 'Transfer'); ?>>Transfer</option>
                        <option value="E-Wallet" <?= set_select('metode_bayar', 'E-Wallet'); ?>>E-Wallet</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="total_bayar" class="form-label">Total Pembayaran</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($jumlah_bayar); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="denda" class="form-label">Denda (Jika Ada)</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($denda); ?>" readonly>
                </div>

                <button type="submit" name="calculate" class="btn btn-secondary">Hitung Total</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <?= form_close(); ?>
        </div>
    </div>
</div>
