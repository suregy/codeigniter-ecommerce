<?php

namespace App\Controllers;

use App\Models\Detprod_m;

class Detprod extends BaseController
{
    protected $detail;

    public function __construct()
    {
        $this->detail = new Detprod_m();
    }

    public function form()
    {
        if ($this->request->isAJAX()) {
            $refid = $this->request->getVar('id');
            $json = [
                'data' => view('Admin/Product/detail'),
                'refid' => $refid,
            ];
            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    public function getOne()
    {
        if ($this->request->isAJAX()) {
            $refid = $this->request->getVar('refid');
            $data = [
                'tampil' => $this->detail->where('product_id', $refid)->findAll()
            ];
            $json = [
                'data' => view('Admin/Product/tabledet', $data),
            ];
            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            $id =  $this->request->getVar('detid');
            $data = [
                'color' => $this->request->getVar('color'),
                'size' => $this->request->getVar('size'),
                'stok' => $this->request->getVar('stok'),
                'product_id' => $this->request->getVar('refid')
            ];
            if (empty($id)) {
                $this->detail->insert($data);
            } else {
                $this->detail->update($id, $data);
            }
            $json = [
                'sukses' => 'data ditambahkan'
            ];
            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    public function destroy()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->detail->delete($id);
            $json = [
                'sukses' => 'Data brands berhasil dihapus'
            ];

            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }
}