@extends("layout.layout")

@section('content')
<div class="header bg-gradient-primary pb-5 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="container-fluid mt-1">
                <!-- Table -->
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header bg-transparent border-0 d-flex justify-content-between">
                                <div class="col-md-8 d-flex">
                                    <h1>Midtrans Payment</h1>
                                </div>
                                <div class="col-md-4 d-flex justify-content-end">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Lihat Detail</a>
                                            <a class="dropdown-item" href="#">Lihat Invoice</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <button id="pay-button">Bayar Sekarang</button>
                            </div>
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                          <pre>  <div id="result-json" class="m-2 p-3"></div></pre>  
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptsheader')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
@endsection

@section('scriptsfooter')
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            language: 'id',
            onSuccess: function (result) {
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            onPending: function (result) {
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            onError: function (result) {
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
</script>
@endsection