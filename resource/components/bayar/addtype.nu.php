<div class="card mt-2">
    <div class="card-header">
        <h5 class="mb-0">Add Type Transaksi</h5>
    </div>
    <div class="card-body mb-2 pb-2" style="">
        <form action="<?= getBaseUrl() ?>pembayaran/addtype" method="post" id="form-type">
            <div class="form-group">
                <label for="input-type">Type Transaksi</label>
                <input type="text" class="form-control" id="input-type" name="type" placeholder="Type Transaksi" required>
            </div>
            <div class="form-group">
                <label for="input-desc">Keterangan Type</label>
                <textarea class="form-control" id="input-desc" name="desc" placeholder="Keterangan Type" required></textarea>
            </div>
            <input type="hidden" id="input-csrf-form" name="csrf" value="<?= App\core\Csrf::get(); ?>">
            <button type="submit" class="btn btn-primary">Submit Type</button>
        </form>
    </div>
</div>