<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'm_supplier';

    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
        'telepon',
        'alamat',
    ];
}
