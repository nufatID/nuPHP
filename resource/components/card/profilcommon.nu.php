<div class="card card-profile shadow">
    <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
                <a href="#">
                    <img src="data:image/png;base64,<?= $member->gambar ?>" class="rounded-circle">
                </a>
            </div>
        </div>
    </div>
    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
        <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
            <a href="#" class="btn btn-sm btn-default float-right">Message</a>
        </div>
    </div>
    <div class="card-body pt-0 pt-md-4">
        <div class="row">
            <div class="col">
                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                        <span class="heading">22</span>
                        <span class="description">Donasi</span>
                    </div>
                    <div>
                        <span class="heading">10</span>
                        <span class="description">Kas</span>
                    </div>
                    <div>
                        <span class="heading">89</span>
                        <span class="description">Tabungan</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <h3>
                <?= $member->nama ?>
            </h3>
            <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>Bucharest, Romania
            </div>
            <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
            </div>
            <div>
                <i class="ni education_hat mr-2"></i>University of Computer Science
            </div>
            <hr class="my-4" />
            <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
            <a href="#">Show more</a>
        </div>
    </div>
</div>