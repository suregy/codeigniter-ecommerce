<?php namespace App\Models;

use CodeIgniter\Model;

class Category_m extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = ['c1','c2','c3'];
    protected $allowedFields = [
        'c1','c2','c3','namacategory'
    ];
    

}