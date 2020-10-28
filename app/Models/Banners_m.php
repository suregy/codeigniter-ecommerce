<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class Banners_m extends Model
{
    protected $table      = 'banners';
    protected $allowedFields = [
        'banner','image','url','status','date_create'
    ];

 
}