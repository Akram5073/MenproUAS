<div class="container mt-4">

    <!-- Bagian Agregasi -->
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title">Rata-rata Pendapatan</h5>
                    <p class="card-text fw-bold text-primary">Rp <?= number_format($agregasi['rata_rata'], 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title">Pendapatan Terendah</h5>
                    <p class="card-text fw-bold text-danger">Rp <?= number_format($agregasi['pendapatan_terendah'], 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="card-title">Pendapatan Tertinggi</h5>
                    <p class="card-text fw-bold text-success">Rp <?= number_format($agregasi['pendapatan_tertinggi'], 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Tabel -->
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            Laporan Pendapatan Bulanan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pendapatan_bulanan)) : ?>
                        <?php foreach ($pendapatan_bulanan as $row) : ?>
                            <?php
                                $current_month = date('F');
                                $highlight = ($row['bulan'] === $current_month) ? 'class="table-success"' : '';
                            ?>
                            <tr <?= $highlight ?>>
                                <td><?= $row['bulan']; ?></td>
                                <td>Rp <?= number_format($row['total_pendapatan'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada data untuk ditampilkan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
