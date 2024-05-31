@extends('layouts.main')
@section('main-box')
<style>
    .bootstrap-select .dropdown-toggle::after {
    right: 0;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="card-box mb-30">
            <div class="pd-20 row justify-content-between m-0">
                <h4 class="text-blue h4">Data Table with Export Buttons</h4>
                <div class="form-group width-5rem">
                    <select class="selectpicker form-control" id="opsi-daftar" data-style="btn-outline-primary" data-size="5">
                        <option selected>All</option>
                        <option>Barang Habis</option>
                        <option>Harga Naik</option>
                        <option>Harga Turun</option>
                    </select>
                </div>
            </div>
            <div class="pb-20" id="tabel-data">

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" id="Medium-modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Form Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
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
    var loading = '<div class="text-center" id="loading" style="width:100%;"><img src="{{ URL::asset('loading.gif') }}" style="height: 5rem"><p class="mb-0" style="font-weight: 600">Loading</p></div>'
    $(document).ready(function(){
        $('#opsi-daftar').val("All");
        loadFile($('#opsi-daftar').val())
    })

    function loadFile(opsi){
        $('#tabel-data').html(loading)
        $.get("{{ url('/data-barang/load') }}/" + opsi,{}, function(data,status){
            $('#tabel-data').html(data);
        })
    }
    function delete_data(id,id_barang) {
        event.preventDefault();
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '/data-barang/'+id_barang+'/delete',
                type: 'GET',
                data:{
                    id : id,
                },
                success: function(response){
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    });
                    loadFile()
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

    function Formedit(id_barang){
        $.get("{{ url('/data-barang/edit') }}/"+id_barang,{}, function(data,status){
            $('#modal-body').html(data);
            $('#Medium-modal').modal('show')
        })
    }

    $("#opsi-daftar").change(function() {
    var selectedValue = $(this).val();
    loadFile(selectedValue)
  });
</script>
@endsection
