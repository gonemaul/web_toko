<table class="table hover data-table-barang nowrap">
    <thead>
        <tr>
            <th class="text-center table-plus datatable-nosort">ID Barang</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">Ukuran</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Harga Beli</th>
            <th class="text-center">Harga Jual</th>
            <th class="text-center datatable-nosort">Action</th>
        </tr>
    </thead>
    <tbody id="body-tabel">
        @foreach ($data as $item)
            <tr>

                @if($item->stok <= 1)
                    <td class="table-plus text-center bg-danger text-white">{{ $item->id_barang }}</td>
                    <td class="bg-danger text-white">{{ $item->nama_barang }}</td>
                    <td class="text-center bg-danger text-white">{{ $item->ukuran }}</td>
                    <td class="text-center bg-danger text-white">{{ $item->stok }}</td>
                @elseif ($item->stok < 4)
                    <td class="table-plus text-center bg-warning text-white">{{ $item->id_barang }}</td>
                    <td class="bg-warning text-white">{{ $item->nama_barang }}</td>
                    <td class="text-center bg-warning text-white">{{ $item->ukuran }}</td>
                    <td class="text-center bg-warning text-white">{{ $item->stok }}</td>
                @else
                    <td class="table-plus text-center">{{ $item->id_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td class="text-center">{{ $item->ukuran }}</td>
                    <td class="text-center">{{ $item->stok }}</td>
                @endif

                @if($item->status != Null)
                    @if($item->status > $item->harga_beli)
                        <td class="text-center text-danger fw-600">{{ $item->harga_beli }}<i class="icon-copy fa fa-arrow-up" style="margin-left: 0.5rem" aria-hidden="true"></i></td>
                    @elseif($item->status < $item->harga_beli)
                        <td class="text-center text-success">{{ $item->harga_beli }}<i class="icon-copy fa fa-arrow-down" style="margin-left: 0.5rem" aria-hidden="true"></i></td>
                    @endif
                @else
                    <td class="text-center">{{ $item->harga_beli }}</td>
                @endif
                    <td class="text-center">{{ $item->harga_jual }}</td>
                <td class="text-center">
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="#" onclick="Formedit({{ $item->id_barang }})"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item btn_delete" href="#" onclick="delete_data({{ $item->id }},{{ $item->id_barang }})"><i class="dw dw-delete-3"></i> Delete</a>
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
<script>
    $(document).ready(function(){
        $('.data-table-barang').DataTable({
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
		columnDefs: [{
			targets: [0],
			orderable: false,
		}],
        "order":[[1, 'asc']],
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'
			}
		},
        dom: 'Bfrtp',
		buttons: [
		'copy', 'csv', 'pdf', 'print'
		]
	});
    })
</script>
