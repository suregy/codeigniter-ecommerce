<?php 
namespace App\Controllers;

use App\Models\Tags_m;

class Tag extends BaseController
{

	protected $tags;

	public function __construct(){
		$this->tags = new Tags_m();
	}

	public function index()
	{	
		$judul = [
			'judul' => 'Daftar Tag',
		];
		return view('Admin/tag/index',$judul);
	}

	function getData(){
		if($this->request->isAJAX()){

			$data = [
				'getdata' => $this->tags->findAll(),
			];

			$json = [
				'data' => view('Admin/tag/table',$data)
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	function formTambah(){
		if($this->request->isAJAX()){

			$json = [
				'data' => view('Admin/tag/modalTambah')
			];

			echo json_encode($json);
		}else{
			exit('maaf tidak dapat diproses');
		}
	}

	function store(){
		if($this->request->isAJAX()){

			$nama = $this->request->getVar('nama');
			$count = count($nama);

			for ($i=0; $i < $count; $i++) { 
				$this->tags->insert([
					'nama' => $nama[$i],
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

	function formEdit(){
		if($this->request->isAJAX()){
			$id = $this->request->getVar('id');
			$row = $this->tags->find($id);

			$data = [
				'nama' => $row['nama'],
				'id' => $row['id'],
			];

			$json = [
				'data' => view('Admin/tag/modalEdit', $data),
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
				'nama' => $this->request->getVar('nama'),
			];

			$this->tags->update($id,$update);

			$json = [
				'sukses' => 'data berhasil di update'
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}


	function delete(){
		if($this->request->isAJAX()){

			$ids = $this->request->getVar('data');
			$id = explode(",", $ids);

			for($i = 0; $i < sizeof($id); $i++){
				$this->tags->delete($id[$i]);
			}

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
