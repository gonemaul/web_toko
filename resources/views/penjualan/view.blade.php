@extends('layouts.main')
@section('main-box')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="card-box mb-30">
            <div class="pb-20 pt-30" id="tabel-data">
                <div class="text-center" id="loading" style="width:100%;">
                    <img src="{{ URL::asset('loading.gif') }}" style="height: 5rem">
                    <p class="mb-0" style="font-weight: 600">Loading</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    {{-- <div class="modal fade bs-example-modal-lg" id="Medium-modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
            </div>
        </div>
    </div> --}}
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        loadFile()
    })

    function loadFile(){
        $.get("{{ url('/data-penjualan/loadSummary') }}",{}, function(data,status){
            $('#tabel-data').html(data);
        })
    }

    function detail(id_transaksi){
        $('#tabel-data').html('')
        id_key = id_transaksi.replace(/\//g,'-')
        $.get("{{ url('/data-penjualan/detail') }}/" + id_transaksi.replace(/\//g,'-'), {} , function(data,status){
            $('#loading').hide()
            $('#tabel-data').html(data);
        })
    }
</script>
@endsection
