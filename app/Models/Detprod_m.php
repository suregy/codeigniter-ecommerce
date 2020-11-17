<?php

namespace App\Models;

use CodeIgniter\Model;

class Detprod_m extends Model
{
    protected $table      = 'product_det';
    protected $allowedFields = [
        'product_id', 'size', 'color', 'stok'
    ];
}