<div class="container mt-4">
    <?php if ($this->input->get('message')): ?>
        <div class="alert alert-<?php echo htmlspecialchars($this->input->get('type') ?? 'info'); ?> alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($this->input->get('message')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">Data Pelanggan</div>
        <div class="card-body">
            <form method="GET" action="<?php echo site_url('index.php/pelanggan'); ?>" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau no telepon..." value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </form>

            <div class="d-flex justify-content-end px-4 mb-3">
                <a href="<?php echo site_url('index.php/add_pelanggan'); ?>" class="btn btn-success btn-sm d-flex align-items-center">
                    <i class="bi bi-plus-circle me-2"></i> Add New Pelanggan
                </a>
            </div>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id Admin</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($pelanggan) > 0): ?>
                        <?php foreach ($pelanggan as $p): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($p['id_admin']); ?></td>
                                <td><?php echo htmlspecialchars($p['id_pelanggan']); ?></td>
                                <td><?php echo htmlspecialchars($p['nama']); ?></td>
                                <td><?php echo htmlspecialchars($p['alamat']); ?></td>
                                <td><?php echo htmlspecialchars($p['email']); ?></td>
                                <td><?php echo htmlspecialchars($p['no_telepon']); ?></td>
                                <td>
                                    <a href="<?php echo site_url('index.php/pelanggan/edit/' . $p['id_pelanggan']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?php echo site_url('index.php/pelanggan/delete/' . $p['id_pelanggan']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">Tidak ada data ditemukan</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php $total_pages = ceil($total_rows / $limit); ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <?php
                            $params = ['page' => $i];
                            if (!empty($search)) $params['search'] = $search;
                            $query_string = http_build_query($params);
                        ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?<?php echo htmlspecialchars($query_string); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
