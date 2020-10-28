<?php 
namespace App\Controllers;

use App\Models\Banners_m;


class Banners extends BaseController
{
    protected $banners;
    protected $helpers;
    public function __construct(){
        $this->banners = new Banners_m();
        helper(['sum_helper','tanggal_helper']);
    }

    public function index(){
        
        $judul = [
            'judul' => 'Daftar Banners',
        ];

        return view('Admin/banners/index',$judul);
    }

    function getData(){
        if($this->request->isAJAX()){
            $data = [
                'getdata' => $this->banners->findAll(),
            ];
            $json = [
                'data' => view('Admin/banners/table',$data),
            ];
            echo json_encode($json);
        }else{
            exit('maaf tidak dapat diproses');
        }
    }

    function uploadImage(){
        $type = explode('.', $_FILES['photo']['name']);
        
    }

    // --------------------------------------------------
}