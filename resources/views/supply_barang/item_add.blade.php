<meta name="csrf-token" content="{{ csrf_token() }}">

<form>
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input class="form-control" type="text" id="id_barang" value="{{ $id_barang }}" name="id_barang" disabled>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input class="form-control" type="text" id="nama_barang" value="{{ $nama_barang }}" name="nama_barang" disabled>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input class="form-control" type="text" value="{{ $ukuran }}" id="ukuran" name="ukuran" disabled>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="banyak" class="form-label">Banyak</label>
                <input class="form-control" type="text" id="banyak" name="banyak">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input class="form-control" type="text" id="harga_satuan" name="harga_satuan">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="total" class="form-label">Total</label>
                <input class="form-control" type="text"  id="total" name="total" disabled  value="0">
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn-success" onclick="tambah_supply({{ $id }})"><i class="icon-copy fa fa-save" aria-hidden="true"></i> Save</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.10.2/dist/autoNumeric.min.js"></script>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var total = 0;
    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#harga_satuan').on('input', function(){
            var banyak = parseFloat($('#banyak').val());
            var harga = parseFloat($('#harga_satuan').val());

            if (!isNaN(banyak) && !isNaN(harga) && banyak > 0) {
                total = banyak * harga;
                $('#total').val(Number(total).toLocaleString());
            } else {
                $('#total').val('-');
            }
        })
    }
    )

    function formatAsCurrency(value) {
        var formattedValue = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
        }).format(value);

        return formattedValue;
    }

    function tambah_supply(id){
        event.preventDefault();
        var banyak_item = $('#banyak').val();
        var harga_satuan = parseFloat($('#harga_satuan').val());
        var subtotal = parseInt(total);

        if(banyak_item && harga_satuan != ''){
            $.ajax({
                type: 'POST',
                url: '/supply-barang/add/store',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_pembelian : id_transaksi,
                    barang_id : id,
                    banyak : banyak_item,
                    harga_satuan : harga_satuan.toLocaleString('id-ID'),
                    total : subtotal.toLocaleString('id-ID')
                },

                success:function(response){
                    item += Number(banyak_item)
                    total_pembelian += subtotal
                    $('#jumlah_item').html(item)
                    $('#total_pembelian').html(formatAsCurrency(total_pembelian))
                    loadFile()
                    $('#Medium-modal').modal('hide');
                    $('#preview').html(btn_preview)
                    $('#save').html(btn_save)
                    Swal.fire({
                        title: "Added!",
                        text: "Your file has been added.",
                        icon: "success"
                    });
                }
            })
        }
        else{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Masukkan data dengan benar!!",
            });
            return
        }
    }
</script>
