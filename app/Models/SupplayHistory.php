<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplayHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function SupplayToInventory(){
        return $this->belongsTo(Inventory::class, 'barang_id','id');
    }
    // public function summary(){
    //     return $this->belongsTo(SupplaySummary::class);
    // }
}
