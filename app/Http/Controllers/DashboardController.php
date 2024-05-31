<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\SalesHistory;
use App\Models\SalesSummary;
use App\Models\SupplayHistory;
use App\Models\SupplaySummary;

class DashboardController extends Controller
{
    public function index(){
        $inventory = Inventory::all();
        $macam = count($inventory);
        $stok = $inventory->sum('stok');
        $saleSummary = SalesSummary::all();
        $terjual = $saleSummary->sum('total_item');
        $supplay = SupplaySummary::sum('total_item');
        $penghasilan = $saleSummary->sum(function ($saleSummary) {
            return str_replace('.', '', $saleSummary->omset);
        });
        $omset = number_format($penghasilan, 0, ',', '.');
        $naik = 0;
        $turun = 0;
        foreach($inventory as $item){
            if($item->terjual != Null){
                if($item->status > $item->harga_beli){
                    $naik += 1;
                }
                elseif($item->status < $item->harga_beli and $item->status != '' or Null){
                    $turun += 1;
                }
            }
        }
        return view('dashboard')->with([
            'stok' => $stok,
            'terjual' => $terjual,
            'supplay' => $supplay,
            'omset' => $omset,
            'naik' => $naik,
            'turun' => $turun,
            'macam' => $macam
        ]);
    }

    public function load(){
        $data = Inventory::orderBy('terjual', 'desc')->limit(5)->get();
        return view('item_dashboard')->with([
            'data' => $data
        ]);
    }
}
