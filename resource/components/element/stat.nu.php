<div class="row">
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">SALDO</h5>
                        <span class="h2 font-weight-bold mb-0"><?= 'Rp. ' . number_format($totals->saldo_akhir, 0, ',', '.') ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
                <?php if (isset($totalsbulan)) { ?>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><?= 'Rp. ' . number_format($totalsbulan->saldo_akhir, 0, ',', '.') ?></span>
                        <span class="text-nowrap">Saldo bulan ini</span>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">KREDIT</h5>
                        <span class="h2 font-weight-bold mb-0"><?= 'Rp. ' . number_format($totals->total_kredit, 0, ',', '.') ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                    </div>
                </div>
                <?php if (isset($totalsbulan)) { ?>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><?= 'Rp. ' . number_format($totalsbulan->total_kredit, 0, ',', '.') ?></span>
                        <span class="text-nowrap">Kredit bulan ini</span>
                    </p> <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">DEBIT</h5>
                        <span class="h2 font-weight-bold mb-0"><?= 'Rp. ' . number_format($totals->total_debit, 0, ',', '.') ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                </div>
                <?php if (isset($totalsbulan)) { ?>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-warning mr-2"><?= 'Rp. ' . number_format($totalsbulan->total_debit, 0, ',', '.') ?></span>
                        <span class="text-nowrap">Debit bulan ini</span>
                    </p> <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Rata rata</h5>
                        <span class="h2 font-weight-bold mb-0"><?= 'Rp. ' . number_format($saldo_per_anggota, 0, ',', '.') ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
                <?php if (isset($totalsbulan)) { ?>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><?= 'Rp. ' . number_format($anggotabulan, 0, ',', '.') ?></span>
                        <span class="text-nowrap">Average Bulan ini</span>
                    </p> <?php } ?>
            </div>
        </div>
    </div>
</div>