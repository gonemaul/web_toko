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
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        loadFile()
    })

    function loadFile(){
        $.get("{{ url('/supply-barang/loadSummary') }}",{}, function(data,status){
            $('#tabel-data').html(data);
        })
    }

    function detailsupply(id_transaksi){
        console.log(id_transaksi)
        $('#tabel-data').html('')
        id_key = id_transaksi.replace(/\//g,'-')
        $.get("{{ url('/supply-barang/detail') }}/" + id_transaksi.replace(/\//g,'-'), {} , function(data,status){
            $('#tabel-data').html(data);
        })
    }
</script>
@endsection
