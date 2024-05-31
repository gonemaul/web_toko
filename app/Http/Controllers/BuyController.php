<?php

namespace App\Http\Controllers;

use App\Models\SupplayHistory;
use App\Models\SupplaySummary;
use App\Models\Inventory;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    // Controller halaman View
    public function index()
    {
        return view('supply_barang.view');
    }

    public function loadFile(SupplayHistory $supplayHistory, Request $request)
    {
        $data = SupplayHistory::where('id_pembelian', $request['id_pembelian'])->get();
        return response()->json(['success' => true,'data' => view('supply_barang.item_tabel')]);
    }


    // Controller Halaman Create
    public function create()
    {
        return view('supply_barang.tambah');
    }

    public function loadAdd(SupplayHistory $supplayHistory, Request $request)
    {
        $data = Inventory::all();
        return view('items.item_tabel')->with([
            'data' => $data,
            'request' => "SupplayAdd"
        ]);
    }

    public function form(Request $request)
    {
        $id = $request->input('id');
        $id_barang = $request->input('id_barang');
        $nama_barang = $request->input('nama_barang');
        $ukuran = $request->input('ukuran');


        return view('supply_barang.item_add', [
            'id' => $id,
            'id_barang' => $id_barang,
            'nama_barang' => $nama_barang,
            'ukuran' => $ukuran,
        ]);
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'id_pembelian' => 'required',
                'barang_id' => 'required',
                'banyak' => 'required',
                'harga_satuan' => 'required',
                'total' => 'required',
            ]);
            SupplayHistory::create($validatedData);
            $inventory = Inventory::where('id',$validatedData['barang_id'])->first();
            $stok = $inventory->stok + $validatedData['banyak'];
            if($inventory->harga_beli != $validatedData['harga_satuan']){
                $inventory->update([
                    'stok' => $stok,
                    'status' => $validatedData['harga_satuan']
                ]);
            }
            $inventory->update([
                'stok' => $stok
            ]);
            return response()->json(['success' => true, 'pesan' => $inventory]);
        }
    }

    public function save(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'id_pembelian' => 'required',
                'tanggal' => 'required',
                'no_nota' => 'required',
                'jumlah_nota' => 'required',
                'total_item' => 'required',
                'total_pembelian' => 'required',
            ]);

            SupplaySummary::create($validatedData);
            return response()->json(['success' => true, 'pesan' => $validatedData]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function loadSummary()
    {
        $data = SupplaySummary::all();
        return view('items.item_summaries')->with([
            'data' => $data,
            'request' => "SupplaySummary"
        ]);
    }


    public function loadDetail($id)
    {
        $id_pembelian = str_replace('-','/',$id);
        $data = SupplayHistory::where('id_pembelian', $id_pembelian)->with('SupplayToInventory')->get();

        return view('items.item_detail')->with([
            'data' => $data,
            'request' => "SupplayDetail"
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplayHistory $supplayHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplayHistory $supplayHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplayHistory $supplayHistory)
    {
        //
    }
}
