<?php

namespace App\Models;

use CodeIgniter\Model;

class Imageprod_m extends Model
{
    protected $table      = 'image_prod';
    protected $allowedFields = [
        'idproduct', 'file'
    ];

    // -------------------------------
}