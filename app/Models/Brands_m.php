<?php namespace App\Models;

use CodeIgniter\Model;

class Brands_m extends Model
{
    protected $table      = 'brands';
    protected $allowedFields = [
        'namabrands'
    ];
}