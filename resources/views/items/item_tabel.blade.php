<table class="table hover data-table nowrap">
    <thead>
        <tr>
            <th class="table-plus">ID Barang</th>
            <th class="table-plus">Nama Barang</th>
            <th class="text-center">Ukuran</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Harga</th>
            <th class="datatable-nosort text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td class="table-plus">{{ $item->id_barang }}</td>
            <td class="table-plus">{{ $item->nama_barang }}</td>
            <td class="text-center">{{ $item->ukuran }}</td>
            <td class="text-center">{{ $item->stok }}</td>
            <td class="text-center">{{ $item->harga_jual }}</td>
            <td class="text-center">
                @if($request == 'SaleAdd')
                    <button class="btn btn-success" onclick="add_barang({{ $item->id }},'{{ $item->harga_beli }}','{{ $item->harga_jual }}')"><i class="icon-copy fi-plus"></i> Add</button>
                @elseif($request == 'SupplayAdd')
                    <button class="btn btn-warning" onclick="add('{{ $item->id }}','{{ $item->id_barang }}','{{ $item->nama_barang }}','{{ $item->ukuran }}')"><i class="icon-copy fi-plus"></i> Add</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ URL::asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('vendors/scripts/datatable-setting.js')}}"></script>
