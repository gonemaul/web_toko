<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesSummary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function History(){
        return $this->hasMany(SalesHistory::class);
    }
}
