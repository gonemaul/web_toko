<meta name="csrf-token" content="{{ csrf_token() }}">
<form class="row">
    @csrf
    <div class="form-group col-md-12">
        <label for="id_barang" class="form-label">ID Barang</label>
        <input class="form-control @error('id_barang') is-invalid @enderror" type="text" value="{{ $data->id_barang }}" id="id_barang" name="id_barang" disabled>
        @error('id_barang')
        <div class="invalid-feedback">
            {{ $message}}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input class="form-control @error('nama_barang') is-invalid @enderror" type="text" value="{{ $data->nama_barang }}" id="nama_barang" name="nama_barang" disabled>
        @error('nama_barang')
        <div class="invalid-feedback">
            {{ $message}}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="ukuran" class="form-label">Ukuran</label>
        <input class="form-control @error('ukuran') is-invalid @enderror" type="text" value="{{ $data->ukuran }}" id="ukuran" name="ukuran" disabled>
        @error('ukuran')
        <div class="invalid-feedback">
            {{ $message}}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="stok" class="form-label">Stok</label>
        <input class="form-control @error('stok') is-invalid @enderror" type="text" value="{{ $data->stok }}" id="stok" name="stok">
        @error('stok')
        <div class="invalid-feedback">
            {{ $message}}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="harga_beli" class="form-label">Harga Beli</label>
        <input class="form-control @error('harga_beli') is-invalid @enderror" type="text" value="{{ str_replace('.', '',$data->harga_beli) }}" id="harga_beli" name="harga_beli">
        @error('harga_beli')
        <div class="invalid-feedback">
            {{ $message}}
        </div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="harga_jual" class="form-label">Harga Jual</label>
        <input class="form-control @error('harga_jual') is-invalid @enderror" type="text" value="{{ str_replace('.', '',$data->harga_jual) }}" id="harga_jual" name="harga_jual">
        @error('harga_jual')
        <div class="invalid-feedback">
            {{ $message}}
        </div>
        @enderror
    </div>
    <button class="btn btn-primary" style="margin-left: 1rem" onclick="btn_update()">Update</button>
</form>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function btn_update(){
        var id_barang = $('#id_barang').val();
        var nama_barang = $('#nama_barang').val();
        var ukuran = $('#ukuran').val();
        var stok = $('#stok').val();
        var harga_beli = $('#harga_beli').val();
        var harga_jual = $('#harga_jual').val();

        event.preventDefault();
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
                url: '/data-barang/'+id_barang+'/update',
                type: 'POST',
                data:{
                    id_barang : id_barang,
                    nama_barang: nama_barang,
                    ukuran:ukuran,
                    stok:stok,
                    harga_beli:Number(harga_beli).toLocaleString(),
                    harga_jual:Number(harga_jual).toLocaleString()
                },
                success: function(response){
                    $('#Medium-modal').modal('hide')
                    Swal.fire({
                    title: "Updated!",
                    text: "Your file has been updated.",
                    icon: "success"
                    });
                    loadFile('All')
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
    }
</script>
