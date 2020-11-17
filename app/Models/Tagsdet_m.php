<?php

namespace App\Models;

use CodeIgniter\Model;

class Tagsdet_m extends Model
{
    protected $table      = 'detail_tags';
    protected $allowedFields = [
        'idproduct', 'idtags'
    ];

    // -------------------------------
}