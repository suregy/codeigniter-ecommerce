<?php namespace App\Models;

use CodeIgniter\Model;

class Category_m extends Model
{
    protected $table      = 'kategori';
    protected $allowedFields = [
        'c1','c2','c3','namacategory'
    ];

    
    public function getC1(){
        $builder = $this->table('kategori');
        $builder->select('c1 , namacategory');
        $builder->where('c2', '0');
        $builder->where('c3', '0');
        return $query = $builder->get()->getResultArray();
       
    }

    public function getC2($c1){
        $builder = $this->table('kategori');
        $builder->select('c2 , namacategory');
        $builder->where('c1', $c1);
        $builder->where('c2 !=', '0');
        $builder->where('c3', '0');
        return $query = $builder->get()->getResultArray();
    }

    public function getC3($c1,$c2){
        $builder = $this->table('kategori');
        $builder->select('c3 , namacategory');
        $builder->where('c1', $c1);
        $builder->where('c2', $c2);
        $builder->where('c3 !=', '0');
        return $query = $builder->get()->getResultArray();
    }

    public function deleteMulti($id) {
        $builder = $this->table('kategori');
        $builder->whereIn('id', $id);
        $builder->delete();
    }

}