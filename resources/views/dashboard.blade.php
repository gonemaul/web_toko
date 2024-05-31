@extends('layouts.main')
@section('main-box')
<div class="pd-ltr-20">
    <div class="row">
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $stok }} <span class="weight-600 font-14">Barang</span></div>
                        {{-- <div class="weight-600 font-14">Barang</div> --}}
                        <div class="weight-600 font-14">Of {{ $macam }} macam</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart2"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $terjual }}</div>
                        <div class="weight-600 font-14">Terjual</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart3"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $supplay }}</div>
                        <div class="weight-600 font-14">Supply</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart4"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">Rp {{ $omset }}</div>
                        <div class="weight-600 font-14">Omset</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">Activity</h2>
                <div id="chart5"></div>
            </div>
        </div>
        <div class="col-xl-4 mb-30">
            <div class="card-box pd-20 justify-content-center">
                {{-- <div class="col-5">
                    <div class="widget-data">
                        <div class="h4 mb-0 text-danger">{{ $naik }}<i class="icon-copy fa fa-arrow-circle-up font-16" style="margin-left: 0.5rem" aria-hidden="true"></i></div>
                        <div class="weight-600 font-16 text-danger">Harga Naik</div>
                    </div>
                </div> --}}
                <div class="d-flex flex-wrap align-items-center justify-content-between pr-30 pl-30">
                    <div class="widget-data">
                        <div class="h4 mb-0 text-danger">{{ $naik }}<i class="icon-copy fa fa-arrow-circle-up font-16" style="margin-left: 0.5rem" aria-hidden="true"></i></div>
                        <div class="weight-600 font-16 text-danger">Harga Naik</div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0 text-success ">{{ $turun }}<i class="icon-copy fa fa-arrow-circle-down font-16" style="margin-left: 0.5rem" aria-hidden="true"></i></div>
                        <div class="weight-600 font-16 text-success">Harga Turun</div>
                    </div>
                </div>
                <hr>
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <div class="widget-data text-center">
                        <div class="h4 mb-0">Rp. 11.983.298</div>
                        <div class="weight-600 font-16">Total Supplay Barang</div>
                    </div>
                </div>
                <hr>
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <div class="widget-data text-center">
                        <div class="h4 mb-0">Rp. 11.983.298</div>
                        <div class="weight-600 font-16">Total Profit</div>
                    </div>
                </div>
                <hr>
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <div class="widget-data text-center">
                        <div class="h4 mb-0">Rp. 11.983.298</div>
                        <div class="weight-600 font-16">Total Aseet Barang</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <h2 class="h4 pd-20">Best Selling Products</h2>
        <div id="tabel-data">
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="vendors/scripts/dashboard.js"></script>
<script>
    $(document).ready(function(){
        loadFile()
    })

    function loadFile(){
        $.get("{{ url('/dashboard/load') }}",{}, function(data,status){
            $('#tabel-data').html(data);
        })
    }
</script>
@endsection
