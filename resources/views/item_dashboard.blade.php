<table class="data-table table nowrap">
    <thead>
        <tr>
            <th class="table-plus datatable-nosort">ID Barang</th>
            <th class="datatable-nosort">Nama Barang</th>
            <th class="datatable-nosort">Ukuran</th>
            <th class="datatable-nosort">Terjual</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td class="table-plus">{{ $item->id_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->ukuran }}</td>
                <td>{{ $item->terjual }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ URL::asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL::asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('vendors/scripts/dashboard.js')}}"></script>
