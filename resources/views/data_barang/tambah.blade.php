@extends('layouts.main')
@section('main-box')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">horizontal Basic Forms</h4>
                    <p class="mb-30">All bootstrap element classies</p>
                </div>
                <div class="pull-right">
                    <a href="#horizontal-basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>
                </div>
            </div>
            <form id="form-input-data">
                @csrf
                <div class="form-group">
                    <label for="id_barang" class="form-label">ID Barang (Opsional)</label>
                    <input class="form-control @error('id_barang') is-invalid @enderror" type="text" placeholder="ID Barang" id="id_barang" name="id_barang">
                    @error('id_barang')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input class="form-control @error('nama_barang') is-invalid @enderror" type="text" placeholder="Nama Barang" id="nama_barang" name="nama_barang" required value="{{ old('nama_barang') }}">
                    @error('nama_barang')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ukuran" class="form-label">Ukuran</label>
                    <input class="form-control @error('ukuran') is-invalid @enderror" type="text" placeholder="Ukuran" id="ukuran" name="ukuran" required value="{{ old('ukuran') }}">
                    @error('ukuran')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stok" class="form-label">Stok</label>
                    <input class="form-control @error('stok') is-invalid @enderror" type="text" placeholder="Stok" id="stok" name="stok" required value="{{ old('stok') }}">
                    @error('stok')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga_beli" class="form-label">Harga Beli</label>
                    <input class="form-control @error('harga_beli') is-invalid @enderror" type="text" placeholder="Harga Beli" id="harga_beli" name="harga_beli" required value="{{ old('harga_beli') }}">
                    @error('harga_beli')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input class="form-control @error('harga_jual') is-invalid @enderror" type="text" placeholder="Harga Jual" id="harga_jual" name="harga_jual" required value="{{ old('harga_jual') }}">
                    @error('harga_jual')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                <button class="btn btn-primary" id="tambah_data">Simpan</button>
            </form>
        </div>
    <div class="footer-wrap pd-20 mb-20 card-box">
        DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#nama_barang').focus()

        function clear(){
            $('#id_barang').val('')
            $('#nama_barang').val('')
            $('#ukuran').val('')
            $('#stok').val('')
            $('#harga_beli').val('')
            $('#harga_jual').val('')
            $('#nama_barang').focus()
        }

        $('#tambah_data').on('click', function tambah_data(e) {
            event.preventDefault();
            var id_barang = $('#id_barang').val();
            var nama_barang = $('#nama_barang').val();
            var ukuran = $('#ukuran').val();
            // var ukuran = $('#ukuran').val();
            var stok = $('#stok').val();
            var harga_beli = $('#harga_beli').val();
            var harga_jual = $('#harga_jual').val();

            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, added it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/data-barang',
                        headers:{
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            id_barang : id_barang,
                            nama_barang: nama_barang.replace(/\b\w/g, function(match) {
                                            return match.toUpperCase();
                                            }),
                            ukuran:ukuran,
                            stok:stok,
                            harga_beli:Number(harga_beli).toLocaleString(),
                            harga_jual:Number(harga_jual).toLocaleString()
                        },
                        success: function(response){
                            clear()
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
                    })}
            });
        })
    })
</script>
@endsection
