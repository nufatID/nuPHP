<div class="col-md-4 py-3">

    <div class="card p-3 mb-2" style="background:#fcf2ff;">
        <div class="d-flex justify-content-between" style="min-height:400;">
            <a href="<?= getBaseUrl() ?>donasi/daftar/{{id}}/{{ link_url }}"> <!-- Add the link here -->
                <div class="d-flex flex-row align-items-center">
                    <div class="icon p-3 m-1"><img src="https://ui-avatars.com/api/?background=random&name=<?= $slot ?>" width="60" class="rounded-circle p-1 m-2"> </div>
                    <div class="ms-2 c-details">
                        <h6 class="mb-0">{{event_name}}</h6> <span>{{date}}</span>
                    </div>
                </div>
            </a>

            <div class="badge"> <a href="<?= getBaseUrl() ?>pembayaran/kredit/donasi/<?= $id ?>"><span>DONASI</span></a>
            </div>

        </div>
        <a href="<?= getBaseUrl() ?>donasi/daftar/{{id}}/{{ link_url }}"> <!-- Add the link here -->
            <div class="mt-5">
                <h3 class="heading">{{slot}}</h3>

                <div class="mt-3">
                    <hr>
                    <div class="mt-1"> <span class="text1"><b>Donasi = RP. <?= number_format($jum, 0, ',', '.') ?>,- </b><br> <i>(<?= convertToWords($jum) ?>)</i></span> </div>
                </div>
            </div>
        </a> <!-- Close the link tag -->
        <div class="d-flex justify-content-center align-items-end" style="height:50px;">
            <a href="<?= getBaseUrl() ?>midtrans/pembayaran/donasi/{{id}}" class="btn btn-primary btn-sm mt-3" style="width:100%;">E-Payment</a>
        </div>
    </div>

</div>