<?php 
namespace App\Controllers;

use App\Models\komikModel;

class Komik extends BaseController
{
	protected $komikModel;
	public function __construct(){
		helper('form');
		$this->session = session();
		$this->komikModel = new komikModel();
	}

	public function index()
	{	
		return view('pages/komik');
	}

	public function save(){
		$this->komikModel->save([
			'username' => $this->request->getPost('username'),
			'password' => $this->request->getPost('password'),
		]);
		
		$this->session->setFlashdata('pesan', 'data berhasil ditambahkan');

		return redirect()->to('/pages');
	}

	//--------------------------------------------------------------------

}
