<?php

namespace App\Http\Controllers;

use App\Models\SalesHistory;
use App\Models\SalesSummary;
use App\Models\Inventory;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penjualan.view');
    }

    public function loadFile()
    {
        $data = Inventory::all();
        return view('items.item_tabel')->with([
            'data' => $data,
            'request' => "SaleAdd"
        ]);
    }

    public function loadSummary()
    {
        $data = SalesSummary::all();
        return view('items.item_summaries')->with([
            'data' => $data,
            'request' => "SaleSummary"
        ]);
    }

    public function loadDetail($id)
    {
        $id_penjualan = str_replace('-','/',$id);
        $data = SalesHistory::where('id_penjualan', $id_penjualan)->with('SaleToInventory')->get();
        // dd($data);
        return view('items.item_detail')->with([
            'data' => $data,
            'request' => "SaleDetail"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjualan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'id_penjualan' => 'required',
                'barang_id' => 'required',
                'tanggal' => 'required',
                'banyak' => 'required',
                'total' => 'required',
                'profit' => 'required'
            ]);


            $inventory = Inventory::find($validatedData['barang_id']);

            if($inventory->stok == 0) {
                return response()->json(['status' => 'habis']);
            }
            else if($inventory->stok < $validatedData['banyak']){
                return response()->json(['status' => 'kurang']);
            }
            else {
                SalesHistory::create($validatedData);
                $stok = $inventory->stok - $validatedData['banyak'];
                $up = $inventory->terjual + $validatedData['banyak'];
                $inventory->update([
                    'stok' => $stok,
                    'terjual' => $up
                ]);
                return response()->json(['status' => 'success', 'pesan' => $inventory->stok]);
            }
        };
    }

    public function save(Request $request)
    {
        if($request->ajax()) {
            $validatedData = $request->validate([
                'tanggal' => 'required',
                'id_penjualan' => 'required',
                'total_item' => 'required',
            ]);

            $data = SalesSummary::where('id_penjualan', $validatedData['id_penjualan'])->first();
            $sale = SalesHistory::where('id_penjualan', $validatedData['id_penjualan'])->get();
            $profit = $sale->sum(function ($sale) {
                return str_replace('.', '', $sale->profit);
            });
            $omset = $sale->sum(function ($sale) {
                return str_replace('.', '', $sale->total);
            });

            $validatedData['omset'] = number_format($omset, 0, ',', '.');
            $validatedData['profit'] = number_format($profit, 0, ',', '.');

            if($data){
                $data->update([
                    'total_item' => $validatedData['total_item'],
                    'omset' => $omset,
                    'profit' => $profit
                ]);
            }
            else{
                SalesSummary::create($validatedData);
            }

            return response()->json(['success' => true, 'pesan' => $validatedData]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesHistory $salesHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesHistory $salesHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesHistory $salesHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesHistory $sale)
    {
        //
    }
}
