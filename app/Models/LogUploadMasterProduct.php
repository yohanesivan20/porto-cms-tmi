<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUploadMasterProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id','uploaded_by_admin_id','upload_type',
        'url_log_file','ip'
    ];
}
