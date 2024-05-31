<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("data_barang.view");
    }

    public function loadFile($request)
    {
        $inventory = Inventory::all();
        if($request == 'All'){
            $data = $inventory;
        }
        else{
            $data = array();
            foreach($inventory as $item)
                if($request == 'Barang Habis'){
                    if($item->stok <= 3){
                        $data[] = $item;
                    }
                }
                elseif($request == 'Harga Naik'){
                    if($item->status and $item->status > $item->harga_beli){
                        $data[] = $item;
                    }
                }
                elseif($request == 'Harga Turun'){
                    if($item->status and $item->status < $item->harga_beli){
                        $data[] = $item;
                    }
                }
        }
        return view('data_barang.item_tabel')->with([
            'data' => $data,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("data_barang.tambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'id_barang' => '',
                'nama_barang' => 'required',
                'ukuran' => 'required',
                'stok' => 'required',
                'harga_beli' => 'required',
                'harga_jual' => 'required'
            ]);
            if($request['id_barang'] == ""){
                $validatedData['id_barang'] = rand(1111111111,9999999999);
            }

            Inventory::create($validatedData);

            return response()->json(['success' => true, 'pesan' => $validatedData]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        return view("data_barang.edit",[
            'data' => $inventory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'id_barang' => 'required',
                'nama_barang' => 'required',
                'ukuran' => 'required',
                'stok' => 'required',
                'harga_beli' => 'required',
                'harga_jual' => 'required'
            ]);

            // return $validatedData;
            Inventory::where('id_barang', $inventory->id_barang)
                    ->update($validatedData);

            return response()->json(['success' => true, 'message' => "Data berhasil diupdate!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {

        Inventory::destroy($inventory->id);
        return response()->json(['success' => true, 'message' => $inventory->id]);
    }
}
