<div class="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-info text-white card-hover">
                    <div class="card-body text-center">
                        <h5 class="card-title">Admin</h5>
                        <h3><?= $adminCount; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white card-hover">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pelanggan</h5>
                        <h3><?= $pelangganCount; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white card-hover">
                    <div class="card-body text-center">
                        <h5 class="card-title">PlayStation</h5>
                        <h3><?= $psCount; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white card-hover">
                    <div class="card-body text-center">
                        <h5 class="card-title">Transaksi</h5>
                        <h3><?= $transaksiCount; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pelanggan -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">Data Pelanggan</div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pelanggan)): ?>
                                    <?php foreach ($pelanggan as $p): ?>
                                        <tr>
                                            <td><?= $p['id_pelanggan']; ?></td>
                                            <td><?= $p['nama']; ?></td>
                                            <td><?= $p['alamat']; ?></td>
                                            <td><?= $p['email']; ?></td>
                                            <td><?= $p['no_telepon']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center">No data found</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
