<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function SaleToInventory(){
        return $this->belongsTo(Inventory::class, 'barang_id','id');
    }
    // public function Summary(){
    //     return $this->belongsTo(SalesSummary::class);
    // }
}
