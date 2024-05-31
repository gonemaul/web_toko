<table class="table hover data-table-export nowrap">
    <thead>
        <tr>
            @if($request == 'SaleSummary')
                <th class="text-center table-plus">ID Penjualan</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Total Item</th>
                <th class="text-center">Omset</th>
                <th class="text-center">Profit</th>

            @elseif($request == 'SupplaySummary')
                <th class="text-center table-plus">ID Pembelian</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">No Nota</th>
                <th class="text-center">Total Item</th>
                <th class="text-center">Total Pembelian</th>
            @endif
            <th class="datatable-nosort text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            @if($request == 'SaleSummary')
                <td class="text-center table-plus">{{ $item->id_penjualan }}</td>
                <td class="text-center">{{ $item->tanggal }}</td>
                <td class="text-center">{{ $item->total_item }}</td>
                <td class="text-center">{{ $item->omset }}</td>
                <td class="text-center">{{ $item->profit }}</td>
            @elseif($request == 'SupplaySummary')
                <td class="text-center table-plus">{{ $item->id_pembelian }}</td>
                <td class="text-center">{{ $item->tanggal }}</td>
                <td class="text-center">{{ $item->no_nota }}</td>
                <td class="text-center">{{ $item->total_item }}</td>
                <td class="text-center">{{ $item->total_pembelian }}</td>
            @endif
            <td class="text-center">
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" role="button" data-toggle="dropdown">
                        <i class="dw dw-more"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        @if($request == 'SaleSummary')
                            <a class="dropdown-item" style="cursor: pointer" onclick="detail('{{ $item->id_penjualan }}')"><i class="icon-copy fa fa-eye" aria-hidden="true"></i> Detail</a>
                        @elseif($request == 'SupplaySummary')
                            <a class="dropdown-item" style="cursor: pointer" onclick="detailsupply('{{ $item->id_pembelian }}')"><i class="icon-copy fa fa-eye" aria-hidden="true"></i> Detail</a>
                        @endif
                    </div>
                </div>
            </td>
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
