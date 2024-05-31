@extends('layouts.main')
@section('main-box')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .info p{
        font-size: 1rem;
        font-weight: 600;
    }
</style>
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-8 info">
                    <p>Tanggal <span style="margin-left: 2.5rem">:</span> <span id="tanggal"></span></p>
                    <p>ID Transaksi <span style="margin-left: 0.5rem">:</span> <span id="id_transaksi"></span></p>
                    <p>Jumlah Item <span style="margin-left: 0.5rem">:</span> <span id="total_item"></span></p>
                </div>
                <div class="col-md-4 text-right" style="height: 100%">
                    <p id="preview"></p>
                    <p id="save"></p>
                </div>
            </div>
        </div>
        <div class="card-box mb-30">
            <div class="pb-20 pt-20" id="tabel-data">
                <div class="text-center" id="loading" style="width:100%;">
                    <img src="{{ URL::asset('loading.gif') }}" style="height: 5rem">
                    <p class="mb-0" style="font-weight: 600">Loading</p>
                </div>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    tanggal = new Date();
    var id_acak = Math.floor(Math.random() * (999 - 100 + 1)) + 100;
    var item = 0;
    var btn_preview_disable = '<button type="button" class="btn btn-primary w-30" disabled><i class="icon-copy ion-android-desktop"></i> Preview</button>'
    var btn_preview = '<button type="button" class="btn btn-primary w-30"><i class="icon-copy ion-android-desktop"></i> Preview</button>'
    var btn_save_disable = '<button type="button" class="btn btn-success w-30" disabled><i class="icon-copy fa fa-save" aria-hidden="true"></i> Simpan</button>'
    var btn_save = '<button type="button" class="btn btn-success w-30" onclick="save()"><i class="icon-copy fa fa-save" aria-hidden="true"></i> Simpan</button>'
    var btn_saved = '<button type="button" class="btn btn-success w-30" disabled><i class="icon-copy fi-check"></i> Saved</button>'

    if (localStorage.getItem('kunci')) {
        var id_transaksi = localStorage.getItem('kunci')
        var item = Number(localStorage.getItem('item'))
        $('#preview').html(btn_preview)
        $('#save').html(btn_save)
    }
    else{
        // var id_transaksi = id_acak + '' + tanggal.toLocaleDateString('id-ID',{ year: '2-digit', month: '2-digit', day: '2-digit' });
        var id_transaksi = id_acak + '09/01/24';
        var item = 0
        $('#total_item').html(item)
        $('#preview').html(btn_preview_disable)
        $('#save').html(btn_save_disable)
    }

    $('#tanggal').html(tanggal.toLocaleDateString('id-ID',{ weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }))
    $('#id_transaksi').html(id_transaksi)
    $('#total_item').html(item)


    $(document).ready(function(){
        loadFile()
    })

    function loadFile(){
        $.get("{{ url('/data-penjualan/load') }}",{}, function(data,status){
            $('#tabel-data').html(data);
        })
    }

    function add_barang(id,beli,jual){
        $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        Swal.fire({
        title: "Masukkan Jumlah Barang",
        input: "text",
        inputAttributes: {
            autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonText: "Confirm",
        showLoaderOnConfirm: true,
        preConfirm: async (qty) => {
            var total =Number(qty)*parseInt(jual.replace(/\./g, ''))
            var profit = total - (Number(qty)*parseInt(beli.replace(/\./g, '')))
            if(qty<=0){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Masukkan jumlah barang dengan benar!!",
                    });
                return
            }
            $.ajax({
            type: 'POST',
            url: '/data-penjualan',
            data: {
                id_penjualan : id_transaksi,
                barang_id : id,
                // tanggal : tanggal.toLocaleDateString('id-ID',{ year: 'numeric', month: '2-digit', day: '2-digit' }),
                tanggal : '09/01/2024',
                banyak : Number(qty),
                total: total.toLocaleString('id-ID'),
                profit: profit.toLocaleString('id-ID')
            },
            success: function(response){
                if(response.status == 'success'){
                    item += Number(qty);
                    $('#total_item').html(item)
                    $('#preview').html(btn_preview)
                    $('#save').html(btn_save)
                    loadFile()

                    if (localStorage.getItem('kunci')) {
                        localStorage.setItem('item', item)
                    }
                    else{
                        localStorage.setItem('kunci', id_transaksi)
                        localStorage.setItem('item', item)
                    }
                    Swal.fire({
                        title: "Added!",
                        text: "Your file has been added.",
                        icon: "success"
                        });
                }
                else if(response.status == 'kurang'){
                    Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Stok barang tidak cukup!!",
                    });
                    return
                }
                else{
                    Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Stok Barang Habis..!!",
                    });
                    return
                }
            },
            error: function (response){
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                });
            }
        })
        },
        });
    }

    function save(){
        $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/data-penjualan/summary',
            data:{
                // tanggal : tanggal.toLocaleDateString('id-ID',{ year: '2-digit', month: '2-digit', day: '2-digit' }),
                tanggal : '09/01/2024',
                id_penjualan : id_transaksi,
                total_item : item,
            },
            success: function(response){
                // console.log(response.pesan)
                $('#save').html(btn_saved)
                localStorage.removeItem('kunci')
                localStorage.removeItem('item')
                Swal.fire({
                title: "Added!",
                text: "Your file has been added.",
                icon: "success"
                });
            },
            error: function (error){
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                });
            }
        })
    }
</script>
@endsection
