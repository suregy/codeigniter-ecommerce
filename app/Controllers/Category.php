<?php namespace App\Controllers;

use App\Models\Category_m;

class Category extends BaseController
{
	protected $category;
	public function __construct(){
        $this->category = new Category_m();
	}

	public function index()
	{
		$judul = [
			'judul' => 'Data Kategori' 
		];
		return view('Admin/categorys/index',$judul);
	}

	public function tampildata(){
		if($this->request->isAJAX()){
			$data = [
				'tampildata' => $this->category->findAll(),
			];
			$json = [
				'data' => view('Admin/categorys/table',$data)
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	public function Formtambah(){
		if($this->request->isAJAX()){
			$json = [
				'data' => view('Admin/categorys/modalTambah')
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	public function save(){
		
		if($this->request->isAJAX()){

			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'cat1' => [
					'label' => 'category 1',
					'rules' => 'required|is_unique[categories.c1]',
					'errors' => [
						'required' => '{field}  harus disi',
						'is_unique' => '{field}  sudah terdaptar'
					]
				],
			]);

			if(!$valid) {

				$json = [
					'error' => [
						'c1' => $validation->getError('cat1'),
					]
				];
			}else{
				$simpanData = [
					'c1' => $this->request->getVar('cat1'),
					'c2' => '0',
					'c3' => '0',
					'namacategory' => $this->request->getVar('namacategory'),
				];

				$this->category->insert($simpanData);

				$json = [
					'sukses' => 'data berhasil disimpan'
				];
			}
			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}
	
	//--------------------------------------------------------------------

}
