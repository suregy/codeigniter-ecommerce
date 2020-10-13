<?php namespace App\Models;

use CodeIgniter\Model;

class komikModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'password'];

}