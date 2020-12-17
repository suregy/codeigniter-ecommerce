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

    public function shop($brand = null, $cat = null)
    {
        $builder = $this->table('products');
        if ($brand !== null && $cat !== null) {
            $builder->where('idbrand', $brand);
            $builder->where('c2', $cat);
        } elseif ($cat !== null) {
            $builder->where('c2', $cat);
        } elseif ($brand !== null) {
            $builder->where('idbrand', $brand);
        } else {
            $builder->select('*');
        }
        return  $builder;
    }

    public function detail($slug)
    {
        $builder = $this->table('products');
        $builder->where('slug', $slug);
        $query = $builder->get()->getResultArray();
        foreach ($query as $i => $prod) {
            $bl = $this->db->table('image_prod');
            $bl->where('idproduct', $prod['id']);
            $img = $bl->get()->getResultArray();
            $query[$i]['images'] = $img;
            $detq = $this->db->table('product_det');
            $detq->where('product_id', $prod['id']);
            $det = $detq->get()->getResultArray();
            $query[$i]['detail'] = $det;
            $dttag = $this->db->table('detail_tags');
            $dttag->select('detail_tags.*, tags.nama');
            $dttag->join('tags', 'detail_tags.idtags = tags.id');
            $dttag->where('detail_tags.idproduct', $prod['id']);
            $tag = $dttag->get()->getResultArray();
            $query[$i]['tags'] = $tag;
        }

        return $query;
    }

    public function store($data)
    {
        $builder = $this->table('products');
        $builder->insert($data);
        return $builder->insertID();
    }
}