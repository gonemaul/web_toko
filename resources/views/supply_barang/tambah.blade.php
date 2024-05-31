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
                <div class="col-md-6 info">
                    <p>Tanggal <span style="margin-left: 4.5rem">:</span> <span id="tanggal">-</span></p>
                    <p>ID Pembelian <span style="margin-left: 2rem">:</span> <span id="id_pembelian">-</span></p>
                    <p>Total Pembelian <span style="margin-left: 0.7rem">:</span> <span id="total_pembelian">-</span></p>
                </div>
                <div class="col-md-6 info">
                    <p>No Nota <span style="margin-left: 2.7rem">:</span> <span id="no_nota">-</span></p>
                    <p>Jumlah Nota <span style="margin-left: 0.5rem">:</span> <span id="jumlah_nota">-</span></p>
                    <p>Jumlah Item <span style="margin-left: 0.7rem">:</span> <span id="jumlah_item">-</span></p>
                </div>
                <div class="row text-center justify-content-end" style="height: 100%;width: 100%">
                    <p style="margin-left: 1rem" id="save"></p>
                    <p style="margin-left: 1rem" id="preview"></p>
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
</div>
{{-- modal --}}
<div class="modal fade bs-example-modal-lg" id="Medium-modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="no_nota" class="form-label">No Nota</label>
                            <input class="form-control" type="text" id="set_no_nota" name="no_nota" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="jumlah_nota" class="form-label">Jumlah Nota</label>
                            <input class="form-control" type="text" id="set_jumlah_nota" name="jumlah_nota" required>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button class="btn btn-success" onclick="set()">Set</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var tanggal = new Date();
    var id_acak = Math.floor(Math.random() * (999 - 100 + 1)) + 100;
    var id_transaksi = id_acak + 'SB/' + tanggal.toLocaleDateString('id-ID',{ month: '2-digit', day: '2-digit' });
    var item = 0
    var total_pembelian = 0
    // preview
    var btn_preview_disable = '<button type="button" class="btn btn-primary w-30" disabled><i class="icon-copy ion-android-desktop"></i> Preview</button>'
    var btn_preview = '<button type="button" class="btn btn-primary w-30"><i class="icon-copy ion-android-desktop"></i> Preview</button>'
    // save
    var btn_save_disable = '<button type="button" class="btn btn-success w-30" disabled><i class="icon-copy fa fa-save" aria-hidden="true"></i> Simpan</button>'
    var btn_save = '<button type="button" class="btn btn-success w-30" onclick="save()"><i class="icon-copy fa fa-save" aria-hidden="true"></i> Simpan</button>'
    var btn_saved = '<button type="button" class="btn btn-success w-30" disabled><i class="icon-copy fi-check"></i> Saved</button>'

    $('#preview').html(btn_preview_disable)
    $('#save').html(btn_save_disable)

    $(document).ready(function(){
        $('#label_modal').html('Supply Barang')
        $('#Medium-modal').modal('show')
        loadFile()
        $('#set_no_nota').focus()
    })

    function set(){
        var no_nota = $('#set_no_nota').val()
        var jumlah_nota = $('#set_jumlah_nota').val()
        if(no_nota != '' && jumlah_nota > 0){
            $('#no_nota').html(no_nota)
            $('#jumlah_nota').html(jumlah_nota)
            $('#tanggal').html(tanggal.toLocaleDateString('id-ID',{ weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }))
            $('#id_pembelian').html(id_transaksi)
            $('#jumlah_item').html(item)
            $('#total_pembelian').html(total_pembelian)
            $('#Medium-modal').modal('hide')
        }
        else{
            return
        }
    }

    function loadFile(){
        $.get("{{ url('/supply-barang/add/load') }}",{}, function(data,status){
            $('#tabel-data').html(data);
        })
    }

    function add(id,barang_id,nama,ukuran) {
        if($('#id_pembelian').html() == '-'){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Masukkan data pembelian terlebih dahulu!!",
            });
            return
        }
        else{
            $.get("{{ url('/supply-barang/add/form') }}", {id:id,id_barang:barang_id,nama_barang:nama,ukuran:ukuran}, function(data,status){
                $('#modal-body').html(data)
                $('#label_modal').html('Supply Barang')
                $('#Medium-modal').modal('show')
            })
        }
    }

    function save(){
        var no = $('#no_nota').html();
        var banyak = $('#jumlah_nota').html();
            $.ajax({
            type: 'POST',
            url: '/supply-barang/add/save',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                id_pembelian : id_transaksi,
                tanggal : tanggal.toLocaleDateString('id-ID',{ year: 'numeric', month: '2-digit', day: '2-digit' }),
                no_nota :no,
                jumlah_nota :banyak,
                total_item: $('#jumlah_item').html().toLocaleString('id-ID'),
                total_pembelian:total_pembelian.toLocaleString('id-ID'),
            },
            success: function(response){
                // console.log(response.pesan)
                $('#save').html(btn_saved)
                Swal.fire({
                title: "Added!",
                text: "Your file has been saved.",
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
