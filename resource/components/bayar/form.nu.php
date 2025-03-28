<div class="col-xl-8 order-xl-1 mt-3">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0" style="text-transform: uppercase;">{{judultype}} {{slot}}</h3>
                </div>
                <div class="col-4 text-right">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#MemberMODAL">
                        MEMBER
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="pl-lg-4">

            </div>
            <form action="<?= getBaseUrl() . "pembayaran/post_" . $slot . ($donid != null ? '/' . $donid : ''); ?>" method="post" id="formbayar">

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Nama</label>
                                <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Nama" name="Nama" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-last-name">Noreg</label>
                                <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Noreg" name="Noreg" readonly required>
                            </div>
                        </div>

                    </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">PEMBAYARAN</h6>
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-control-label" for="input-jumlah">Jumlah Rupiah</label>
                                <input id="input-jumlah" class="form-control form-control-alternative" type="text" value="Rp. 50.000" name="jumlah" required>
                                <p id="output-terbilang" class="terbilang-box"></p>
                            </div>

                        </div>

                        <?php if ($slot == 'kas') : ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Type Transaksi</label>
                                    <select class="form-control form-control-alternative" name="jenis">
                                        <?php foreach ($paymentType as $jenis) : ?>
                                            <option value="<?= $jenis['id'] ?>"><?= $jenis['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php elseif ($slot == 'donasi') : ?>
                            <input type="hidden" name="jenis" readonly value="2">
                        <?php else : ?>
                            <input type="hidden" name="jenis" readonly value="<?= Carbon\Carbon::now()->format('Y') ?>">
                        <?php endif; ?>
                    </div>

                </div>

                <div class="pl-lg-4">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <div class="grow-wrap">
                            <textarea rows="4" class="form-control form-control-alternative" placeholder="Keterangan" name="keterangan" onInput="this.parentNode.dataset.replicatedValue = this.value" required>pembayaran <?= date('F') . ' ' . date('Y') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="hidden" id="input-id" name="member_id" value="" class="form-control form-control-alternative">
                        <input type="hidden" id="input-csrf" name="csrf" value="<?= App\core\Csrf::get(); ?>">
                        <input type="hidden" id="input-kri" name="kriteria" value="<?= $slot; ?>">
                        <input type="hidden" id="input-kride" name="type" value="<?= $type; ?>">
                    </div>
                </div>
                <div class="row" id="submitbayar" style="display: none;">
                    <div class="col-6 text-right px-3">
                        <a href="<?= getBaseUrl() . "pembayaran"; ?>" class="btn btn-secondary btn-lg btn-block mt-4" role="button" aria-pressed="true"><i class="fas fa-ban"></i> Clear</a>
                    </div>
                    <div class="col-6 text-left">
                        <button type="submit" class="btn btn-primary btn-lg btn-block mt-4" role="button" aria-pressed="true"><i class="fas fa-paper-plane"></i> Submit Pembayaran</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scriptsheader')
<style>
    .grow-wrap {
        /* easy way to plop the elements on top of each other and have them both sized based on the tallest one's height */
        display: grid;
    }

    .grow-wrap::after {
        /* Note the weird space! Needed to preventy jumpy behavior */
        content: attr(data-replicated-value) " ";

        /* This is how textarea text behaves */
        white-space: pre-wrap;

        /* Hidden from view, clicks, and screen readers */
        visibility: hidden;
    }

    .grow-wrap>textarea {
        /* You could leave this, but after a user resizes, then it ruins the auto sizing */
        resize: none;

        /* Firefox shows scrollbar on growth, you can hide like this. */
        overflow: hidden;
    }

    .grow-wrap>textarea,
    .grow-wrap::after {
        /* Identical styling required!! */

        padding: 0.5rem;
        font: inherit;

        /* Place on top of each other */
        grid-area: 1 / 1 / 2 / 2;
    }

    .terbilang-box {
        padding: 10px;
        font-style: italic;
        color: gray;
    }
</style>
@endsection