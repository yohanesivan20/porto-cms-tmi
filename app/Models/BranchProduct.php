<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id','status_master_product_id','master_product_id','price',
        'min_order','min_qty','max_qty'
    ];
}
