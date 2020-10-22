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
			'judul' => 'Data Kategori',
			'data' => $this->category->getC1()
		];
		return view('Admin/categorys/index',$judul);
	}

	public function tampildata(){
		if($this->request->isAJAX()){
			$data = [
				'tampildata' => $this->category->orderBy('c1 asc, c2 asc, c3 asc')->findAll(),
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
				'data' => view('Admin/categorys/modalTambah'),	
				'c1' => $this->category->getC1()
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	public function FormtambahBanyak(){
		
		if($this->request->isAJAX()){
			
			$json = [
				'data' => view('Admin/categorys/FormTambahBanyak'),
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	public function getC2(){
		if($this->request->isAJAX()){
			$c1 = $this->request->getVar('c1');
			$json = [	
				'c2' => $this->category->getC2($c1)
			];

			echo json_encode($json);


		}else{
			exit('maaf tidak dapat diproses');
		}

	}

	public function Formtambahcat(){
		if($this->request->isAJAX()){
			$c2 = $this->request->getVar('c2');
			$json = [
				'data' => view('Admin/categorys/modalTambahcat')
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	public function FormEdit(){
		if($this->request->isAJAX()){
			$id = $this->request->getVar('id');
			$row = $this->category->where('id', $id)->first();



			$data = [
				'c1' => $row['c1'],
				'c2' => $row['c2'],
				'c3' => $row['c3'],
				'nmcat' => $row['namacategory'],
				'id' => $row['id'],
			];
			$json = [
				'data' => view('Admin/categorys/Formedit',$data),
				'cmb1' => $this->category->getC1(),
				'cmb2' => $this->category->getC2($row['c1']),
				'value' => $data,
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	public function updateData(){
		if($this->request->isAJAX()){

			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'c3' => [
					'label' => 'category 3',
					'rules' => 'required',
					'errors' => [
						'required' => '{field}  harus disi'
					]
				],
				'nmc3' => [
					'label' => 'category 3',
					'rules' => 'required',
					'errors' => [
						'required' => '{field}  harus disi'
					]
				],
				'c1' => [
					'label' => 'category 1',
					'rules' => 'required|greater_than[0]',
					'errors' => [
						'required' => '{field}  harus disi',
						'greater_than' => '{field}  harus dipilih',
					]
				],
				'c2' => [
					'label' => 'category 2',
					'rules' => 'required|greater_than[0]',
					'errors' => [
						'required' => '{field}  harus disi',
						'required' => '{field}  harus dipilih',
					]
				],
			]);

			if(!$valid) {

				$json = [
					'error' => [
						'c3' => $validation->getError('c3'),
						'nmc3' => $validation->getError('nmc3'),
						'c1' => $validation->getError('c1'),
						'c2' => $validation->getError('c2'),
					]
				];

			}else{

				$id = $this->request->getVar('id');

				$simpanData = [
					'c1' => $this->request->getVar('c1'),
					'c2' => $this->request->getVar('c2'),
					'c3' => $this->request->getVar('c3'),
					'namacategory' => $this->request->getVar('nmc3'),
				];


				$this->category->update($id, $simpanData);

				$json = [
					'sukses' => 'data berhasil diupdate',
				];

			}

			echo json_encode($json);


		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	public function Simpanc1(){
		
			if($this->request->isAJAX()){

				$validation = \Config\Services::validation();
	
				$valid = $this->validate([
					'c1' => [
						'label' => 'isi code kategori',
						'rules' => 'required|is_unique[kategori.c1]',
						'errors' => [
							'required' => '{field}  harus disi',
							'is_unique' => '{field}  sudah terdaptar'
						]
					],
					'nmc1' => [
						'label' => 'isi nama kategori',
						'rules' => 'required',
						'errors' => [
							'required' => '{field}  harus disi',
						]
					],
				]);
	
				if(!$valid) {
	
					$json = [
						'error' => [
							'c1' => $validation->getError('c1'),
							'nmc1' => $validation->getError('nmc1'),
						]
					];
				}else{
					$simpanData = [
						'c1' => $this->request->getVar('c1'),
						'c2' => '0',
						'c3' => '0',
						'namacategory' => $this->request->getVar('nmc1'),
					];
	
					$this->category->insert($simpanData);
	
					$json = [
						'sukses' => 'data c1 berhasil disimpan'
					];
				}
				echo json_encode($json);
			}else{
				exit('maaf tidak dapat diproses');
			}
	
	}

	public function Simpanc2(){
		
		if($this->request->isAJAX()){


			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'c2' => [
					'label' => 'isi code kategori 2',
					'rules' => 'required',
					'errors' => [
						'required' => '{field}  harus disi',
						'required' => '{field}  harus dipilih',
					]
				],
				'nmc2' => [
					'label' => 'isi nama kategori',
					'rules' => 'required',
					'errors' => [
						'required' => '{field}  harus disi',
					]
				],
				'c1' => [
					'rules' => 'required|greater_than[0]',
					'errors' => [
						'required' => '{field}  harus disi',
						'greater_than' => '{field}  harus dipilih',
					]
				],
			]);

			if(!$valid) {

				$json = [
					'error' => [
						'c1' => $validation->getError('c1'),
						'c2' => $validation->getError('c2'),
						'nmc2' => $validation->getError('nmc2'),
					]
				];
			}else{
				$simpanData = [
					'c1' => $this->request->getVar('c1'),
					'c2' => $this->request->getVar('c2'),
					'c3' => '0',
					'namacategory' => $this->request->getVar('nmc2'),
				];

				$this->category->insert($simpanData);

				$json = [
					'sukses' => 'data c1 berhasil disimpan'
				];
			}
			echo json_encode($json);
		}else{
			exit('maaf tidak dapat diproses');
		}

}

	public function save(){
		
		if($this->request->isAJAX()){

			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'c3' => [
					'label' => 'category 3',
					'rules' => 'required',
					'errors' => [
						'required' => '{field}  harus disi'
					]
				],
				'nmc3' => [
					'label' => 'category 3',
					'rules' => 'required',
					'errors' => [
						'required' => '{field}  harus disi'
					]
				],
				'c1' => [
					'label' => 'category 1',
					'rules' => 'required|greater_than[0]',
					'errors' => [
						'required' => '{field}  harus disi',
						'greater_than' => '{field}  harus dipilih',
					]
				],
				'c2' => [
					'label' => 'category 2',
					'rules' => 'required|greater_than[0]',
					'errors' => [
						'required' => '{field}  harus disi',
						'required' => '{field}  harus dipilih',
					]
				],
			]);

			if(!$valid) {

				$json = [
					'error' => [
						'c3' => $validation->getError('c3'),
						'nmc3' => $validation->getError('nmc3'),
						'c1' => $validation->getError('c1'),
						'c2' => $validation->getError('c2'),
					]
				];
			}else{
				$simpanData = [
					'c1' => $this->request->getVar('c1'),
					'c2' => $this->request->getVar('c2'),
					'c3' => $this->request->getVar('c3'),
					'namacategory' => $this->request->getVar('nmc3'),
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

	public function saveAll(){
		
		if($this->request->isAJAX()){
			
				$c1 = $this->request->getVar('c1');
				$c2 = $this->request->getVar('c2');
				$c3 = $this->request->getVar('c3');
				$nmcat = $this->request->getVar('nmcat');

				$count = count($c1);

				for($i= 0; $i < $count; $i++){
					$this->category->insert([
						'c1' => $c1[$i],
						'c2' => $c2[$i],
						'c3' => $c3[$i],
						'namacategory' => $nmcat[$i],
					]);
				}

				$json = [
					'sukses' => "$count data berhasil disimpan"
				];
			
			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	public function delete(){
		if($this->request->isAJAX()){

			$idAll = $this->request->getVar('data');
			
			
			$this->category->deleteMulti($idAll);

			// for($i = 0; $i < $count ; $i++){
			// 	$this->category->delete($count[$i]);
			// }

			$json = [
				'sukses' => 'data berhasil dihapus',
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}

	}
	
	
	//--------------------------------------------------------------------

}
