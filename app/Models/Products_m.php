<?php

namespace App\Models;

use CodeIgniter\Model;

class Products_m extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['c1', 'c2', 'c3', 'idbrand', 'nama', 'slug', 'deskripsi', 'hrgbeli', 'hrgjual', 'image'];

    public function joinBrand()
    {
        $builder = $this->table('products');
        $builder->select('products.* , brands.namabrands');
        $builder->join('brands', 'brands.id = products.idbrand');
        return $query = $builder->get()->getResultArray();
    }

    public function filter($c1 = null, $c2 = null, $c3 = null)
    {
        $builder = $this->table('products');
        $builder->select('products.* , brands.namabrands');
        $builder->join('brands', 'brands.id = products.idbrand');
        if ($c1 !== null) {
            $builder->where('products.c1', $c1);
        }
        if ($c2 !== null) {
            $builder->where('products.c2', $c2);
        }
        if ($c3 !== null) {
            $builder->where('products.c3', $c3);
        }
        return $query = $builder->get()->getResultArray();
    }

    public function shop($brand = null)
    {
        $builder = $this->table('products');
        if ($brand !== null) {
            $builder->where('idbrand', $brand);
        } else {
            $builder->select('*');
        }
        return  $builder;
    }

    public function store($data)
    {
        $builder = $this->table('products');
        $builder->insert($data);
        return $builder->insertID();
    }
}