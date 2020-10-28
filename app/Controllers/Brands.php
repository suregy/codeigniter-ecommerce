<?php 
namespace App\Controllers;

use App\Models\Brands_m;

class Brands extends BaseController
{
    protected $brands;
    public function __construct(){
        $this->brands = new Brands_m();
        
    }

    function index(){
        $judul = [
            'judul' => 'Daftar Brands'
        ];
        return view('Admin/brands/index', $judul);
    }

    function getData(){
        if($this->request->isAJAX()){

            $data = [
                'getdata' => $this->brands->findAll(),
            ];
            $json = [
                'data' => view('Admin/brands/table',$data),
            ];

            echo json_encode($json);

        }else{
            exit('maaf tidak dapat diproses');
        }
    }

    function formTambah(){
        if($this->request->isAJAX()){
            $json = [
                'data' => view('Admin/brands/modalTambah'),
            ];
            echo json_encode($json);
        }else{
            exit('maaf tidak dapat diproses');
        }
    }

    function store(){
        if($this->request->isAJAX()){
            $namabrands = $this->request->getVar('nama');
            $count = count($namabrands);

            for ($i=0; $i < $count ; $i++) { 
                $this->brands->insert([
                    'namabrands' => $namabrands[$i],
                ]);
            }

            $json = [
                'sukses' => 'Nama Brands berhasil disimpan'
            ];

            echo json_encode($json);

        }else{
            exit('maaf tidak dapat diproses');
        }
    }

    function formEdit(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('id');
            $row = $this->brands->find($id);

            $data = [
                'id' => $row['id'],
                'namabrands' => $row['namabrands'],
            ];

            $json = [
                'data' => view('Admin/brands/modalEdit',$data)
            ];

            echo json_encode($json);
        }else{
            exit('maaf tidak dapat diproses');
        }
    }

    function update(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('id');
            $update = [
                'namabrands' => $this->request->getVar('nama'),
            ];

            $this->brands->update($id, $update);

            $json = [
                'sukses' => 'Data berhasil diupdate'
            ];

            echo json_encode($json);

        }else{
            exit('maaf tidak dapat diproses');
        }
    }

    function delete(){
        if($this->request->isAJAX()){
            $ids = $this->request->getVar('id');
            $id = explode(",", $ids);

            for ($i=0; $i < sizeof($id) ; $i++) { 
                $this->brands->delete($id[$i]);
            }

            $json = [
                'sukses' => 'Data brands berhasil dihapus'
            ];

            echo json_encode($json);

        }else{
            exit('maaf tidak dapat diproses');
        }
    }

}