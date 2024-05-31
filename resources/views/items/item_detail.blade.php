<style>
    .kepala_info{
        font-size: 1rem;
        font-weight: 600;
    }
</style>
<div class="row kepala_info mb-10" style="margin-left: 1rem">
    <button style="margin-right: 1rem; cursor: pointer;"  class="btn btn-primary" onclick="window.location.reload();">Kembali</button>
    @if($request == 'SaleDetail')
        <p class="text-center">ID Transaksi <span style="margin-left: 0.5rem;margin-right: 0.5rem">:</span> <span>{{ $data['0']->id_penjualan }}</span></p>
    @elseif($request == 'SupplayDetail')
        <p class="text-center">ID Transaksi <span style="margin-left: 0.5rem;margin-right: 0.5rem">:</span> <span>{{ $data['0']->id_pembelian }}</span></p>
    @endif
</div>
<table class="table hover nowrap">
    <thead>
        <tr>
            @if($request == 'SaleDetail')
                <th class="text-center table-plus">ID Barang</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Ukuran</th>
                <th class="text-center">Banyak</th>
                <th class="text-center">Total</th>
                <th class="text-center">Profit</th>
            @elseif($request == 'SupplayDetail')
                <th class="table-plus text-center">ID Barang</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Ukuran</th>
                <th class="text-center">Banyak</th>
                <th class="text-center">Harga Satuan</th>
                <th class="text-center">Total</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            @if($request == 'SaleDetail')
                <td class="text-center table-plus">{{ $item->SaleToInventory->id_barang }}</td>
                <td class="text-center">{{ $item->SaleToInventory->nama_barang }}</td>
                <td class="text-center">{{ $item->SaleToInventory->ukuran }}</td>
                <td class="text-center">{{ $item->banyak }}</td>
                <td class="text-center">{{ $item->total }}</td>
                <td class="text-center">{{ $item->profit }}</td>
            @elseif($request == 'SupplayDetail')
                <td class="text-center table-plus">{{ $item->SupplayToInventory->id_barang }}</td>
                <td class="text-center">{{ $item->SupplayToInventory->nama_barang }}</td>
                <td class="text-center">{{ $item->SupplayToInventory->ukuran }}</td>
                <td class="text-center">{{ $item->banyak }}</td>
                <td class="text-center">{{ $item->harga_satuan }}</td>
                <td class="text-center">{{ $item->total }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ URL::asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<!-- buttons for Export datatable -->
<script src="{{ URL::asset('src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/buttons.print.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/pdfmake.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/vfs_fonts.js')}}"></script>
<script src="{{ URL::asset('vendors/scripts/datatable-setting.js')}}"></script>
