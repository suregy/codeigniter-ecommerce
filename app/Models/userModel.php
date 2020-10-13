<?php namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'uid';
    protected $allowedFields = [
        'email', 
        'password', 
        'namadepan', 
        'namabelakang', 
        'notelpon' , 
        'tgllahir',
        'tglregister',
        'status',
        'photo'
    ];
    

}