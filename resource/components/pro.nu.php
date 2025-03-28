<div class="card card-profile shadow">
    <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
                <a href="#">
                    <img src="data:image/png;base64,<?= member_login()->gambar ?>" class="rounded-circle" height="150">
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
        <div class="text-center">
            <h3 class="mt-2">
                <?= member_login()->nama ?>
            </h3>

            <div class="h5 mt-5">
                <i class="ni business_briefcase-24 mr-2"></i><?= my_job() ?>
            </div>

        </div>
    </div>
</div>