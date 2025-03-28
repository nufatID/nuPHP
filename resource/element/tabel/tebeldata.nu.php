      <div class="table-responsive">
                                  <table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Transaksi</th>
            <th scope="col">Nama</th>
            <th scope="col">Noreg</th>
            <th scope="col">Status</th>
            <th scope="col" style="width: 2%;"></th>
            <th scope="col">Jumlah</th>
            <th scope="col">Tanggal</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($transactions)) { ?>
            <tr>
                <td colspan="9" class="text-center">Tidak ada data tersedia</td>
            </tr>
        <?php } else { ?>
            <?php foreach ($transactions as $nomor => $value) { ?>
                <tr>
                    <td><?= $nomor + 1 ?></td>
                    <td><a href="<?= getBaseUrl() . "pembayaran/resume/tabungan/" . $value["judul"]; ?>"> <?= $value["judul"] ?></a></td>
                    <td><?= strnama($value->member->nama); ?></td>
                    <td><?= $value->member->noreg; ?></td>
                    <td>
                        <span class="badge badge-dot mr-4">
                            <?php if ($value->type == 'debit') { ?>
                                <i class="bg-danger"></i>
                            <?php } else { ?>
                                <i class="bg-success"></i>
                            <?php } ?>
                            <?= $value->type; ?>
                        </span>
                    </td>
                    <td>Rp.</td>
                    <td style="text-align:right;font-weight:bold;font-size:16px;">
                        <?= number_format($value->jumlah, 0, ',', '.') . ' ,-'; ?>
                    </td>
                    <td><?= $value->date; ?></td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="<?= getBaseUrl() . "pembayaran/tabungan/kas/" . $value["judul"]; ?>">Lihat Detail</a>
                                <a class="dropdown-item" href="#">Lihat Invoice</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9" class="text-center">Total: <?= count($transactions) ?> transaksi</td>
        </tr>
    </tfoot>
</table>
                                
            </div>      
                        