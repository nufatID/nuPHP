<div class="modal fade" id="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>" tabindex="-1" role="dialog" aria-labelledby="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>Label">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin akan mengirim data ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>btn">Ya</button>
            </div>
        </div>
    </div>
</div>