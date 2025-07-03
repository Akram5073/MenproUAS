<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="text-secondary">Tabel berikut menampilkan data transaksi lengkap beserta detail item dan pembayaran.</h6>
                <a href="<?php echo base_url('index.php/add_transaksi'); ?>" class="btn btn-success">+ Add New Transaksi</a>
            </div>
            <table id="transaksiTable" class="table table-bordered table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Pelanggan</th>
                        <th>Detail Item</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Tanggal Bayar</th>
                        <th>Metode Bayar</th>
                        <th>Jumlah Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($transaksi)): ?>
                        <?php foreach ($transaksi as $row): ?>
                            <tr>
                                <td><?php echo $row->id_transaksi; ?></td>
                                <td><?php echo $row->pelanggan_nama; ?></td>
                                <td><?php echo $row->detail_item; ?></td>
                                <td><?php echo $row->tanggal_sewa; ?></td>
                                <td><?php echo $row->tanggal_kembali; ?></td>
                                <td><?php echo ($row->tanggal_bayar ?? '<span class="text-danger">Belum Dibayar</span>'); ?></td>
                                <td><?php echo ($row->metode_bayar ?? '-'); ?></td>
                                <td><?php echo ($row->jumlah_bayar ? '<span class="fw-bold text-success">Rp ' . number_format($row->jumlah_bayar, 2, ',', '.') . '</span>' : '-'); ?></td>
                                <td><?php echo $row->status; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="9">No transactions found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables JS -->
<script>
    $(document).ready(function () {
        $('#transaksiTable').DataTable({
            "order": [[3, "desc"]]
        });
    });
</script>
