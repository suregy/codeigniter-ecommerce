<?php

namespace App\Controllers;

use App\Models\Banners_m;


class Banners extends BaseController
{
    protected $banners;
    protected $helpers;
    public function __construct()
    {
        $this->banners = new Banners_m();
        helper(['sum_helper', 'tanggal_helper', 'form']);
    }

    public function index()
    {

        $judul = [
            'judul' => 'Daftar Banners',
        ];

        return view('Admin/banners/index', $judul);
    }

    function getData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'getdata' => $this->banners->findAll(),
            ];
            $json = [
                'data' => view('Admin/banners/table', $data),
            ];
            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    function formTambah()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('Admin/banners/modalTambah'),
            ];
            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    function store()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'file' => [
                    'rules' => 'uploaded[photo]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'pilih gambar dahulu',
                        'is_image' => 'yang dipilih bukan gambar',
                        'mime_in' => 'yang dipilih bukan gambar',
                    ]
                ],
                'judul' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul tidak boleh kosong'
                    ],
                ],
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'status harus dipilih'
                    ],
                ],
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'file' => $validation->getError('file'),
                        'judul' => $validation->getError('judul'),
                        'status' => $validation->getError('status'),
                    ]
                ];
            } else {
                $judul = $this->request->getVar('judul');
                $url = $this->request->getVar('url');
                $status = $this->request->getVar('status');
                $date = $this->request->getVar('date');
                $image = $this->request->getFile('photo');
                $randomName = $image->getRandomName();


                $data = [
                    'banner' => $judul,
                    'url' => $url,
                    'status' => $status,
                    'date_create' => $date,
                    'image' => $randomName,
                ];

                $insert = $this->banners->insert($data);

                if ($insert) {
                    $image->move('images/banners', $randomName);
                }

                $json = [
                    'sukses' => 'data berhasil disimpan'
                ];
            }
            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    function formEdit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $row = $this->banners->find($id);
            $data = [
                'id' => $row['id'],
                'banner' => $row['banner'],
                'image' => $row['image'],
                'url' => $row['url'],
                'status' => $row['status'],
                'date_create' => $row['date_create'],
            ];

            $json = [
                'data' => view('Admin/banners/modalEdit', $data)
            ];

            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'file' => [
                    'rules' => 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'is_image' => 'yang dipilih bukan gambar',
                        'mime_in' => 'yang dipilih bukan gambar',
                    ]
                ],
                'judul' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul tidak boleh kosong'
                    ],
                ],
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'status harus dipilih'
                    ],
                ],
            ]);

            if (!$valid) {
                $json = [
                    'error' => [
                        'file' => $validation->getError('file'),
                        'judul' => $validation->getError('judul'),
                        'status' => $validation->getError('status'),
                    ]
                ];
            } else {
                $id = $this->request->getVar('id');
                $judul = $this->request->getVar('judul');
                $url = $this->request->getVar('url');
                $status = $this->request->getVar('status');
                $date = $this->request->getVar('date');
                $image = $this->request->getFile('photo');

                if ($image->getError() == 4) {
                    $randomName = $this->request->getVar('imageold');
                } else {
                    $randomName = $image->getRandomName();
                    $image->move('images/banners', $randomName);
                    unlink('images/banners/' . $this->request->getVar('imageold'));
                }

                $data = [
                    'banner' => $judul,
                    'url' => $url,
                    'status' => $status,
                    'date_create' => $date,
                    'image' => $randomName,
                ];

                $insert = $this->banners->update($id, $data);

                $json = [
                    'sukses' => 'data berhasil disimpan'
                ];
            }
            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    function delete()
    {
        if ($this->request->isAJAX()) {
            $ids = $this->request->getVar('id');
            $id = explode(",", $ids);

            for ($i = 0; $i < sizeof($id); $i++) {

                $image = $this->banners->where('id', $id[$i])->first();

                if (file_exists('images/banners/' . $image['image'])) {
                    unlink('images/banners/' . $image['image']);
                }

                $this->banners->delete($id[$i]);
            }

            $json = [
                'sukses' => 'Data banners berhasil dihapus'
            ];

            echo json_encode($json);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    // --------------------------------------------------
}
