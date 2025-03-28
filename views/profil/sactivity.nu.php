@extends("layout.layout")

<div class="header pb-5 pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-7"></span>
    <div class="container-fluid d-flex align-items-center mt--3">

    </div>
</div>

<div class="container-fluid mt--9 pb-4">
    <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white">Aktivitas</h1>

    </div>
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="donasi-tab" href="javascript:void(0);" onclick="loadContent('donasi');" role="tab" aria-controls="donasi">DONASI</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="kas-tab" href="javascript:void(0);" onclick="loadContent('kas');" role="tab" aria-controls="kas">KAS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabungan-tab" href="javascript:void(0);" onclick="loadContent('tabungan');" role="tab" aria-controls="tabungan">TABUNGAN</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div id="tabContent" class="tabContent">
                        <!-- Konten awal akan dimuat di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@section('scriptsfooter')
<script>
    function loadContent(tabName) {
        var urlMap = {
            donasi: '<?= get_url('account/activity/tab?tab=donasi') ?>',
            kas: '<?= get_url('account/activity/tab?tab=kas') ?>',
            tabungan: '<?= get_url('account/activity/tab?tab=tabungan') ?>'
        };

        // Gunakan AJAX untuk memuat konten dari URL yang sesuai
        fetch(urlMap[tabName])
            .then(response => response.text())
            .then(data => {
                document.getElementById('tabContent').innerHTML = data;
                // Update active class
                $('.nav-link').removeClass('active pastel-bg');
                $('#' + tabName + '-tab').addClass('active pastel-bg');
            })
            .catch(error => console.error('Error loading content:', error));
    }

    $(document).ready(function() {
        // Muat konten awal (misalnya DONASI)
        loadContent('donasi');
    });
</script>
@endsection

@section('scriptsheader')
<style>
    .tab-pane {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .tabContent {
        min-height: 500px;
    }

    .nav-link.active {
        color: red !important;
        /* Pastel background color text */
    }

    .nav-link.pastel-bg {
        background-color: #f0fff !important;
        /* Pastel background color */
        color: blue;
        /* Change text color */
    }
</style>
@endsection