<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\Category_m;
use App\Libraries\Notifikasi;


class Auth extends BaseController
{
	protected $userModel;
	protected $now;

	public function __construct()
	{
		helper('form', 'date');
		$this->userModel = new userModel();
		$this->cat = new Category_m();
		$this->session = session(); //pindah ke base controller
		$this->notif = new Notifikasi();
		$this->now = date('Y-m-d');
	}

	public function index()
	{
		if ($this->session->has('pesan')) {
			$data = [
				'validation' => \Config\Services::validation(),
				'pesan' => $this->session->get('pesan')
			];
		} else {
			$data = [
				'validation' => \Config\Services::validation(),
				'pesan' => ''
			];
		};
		// $data = [
		// 	'validation' => \Config\Services::validation(),
		// 	'pesan' => 'tes'
		// ];

		return view('Auth/login', $data);
	}

	public function login()
	{

		//validasi input
		if (!$this->validate([
			'email' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field}  harus disi',
					'is_unique' => '{field}  sudah terdaptar'
				]
			],

			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field}  harus disi',
				]
			],
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to('/auth')->withInput()->with('validation', $validation);
		}

		// $pass = password_hash($this->request->getPost('email'), PASSWORD_DEFAULT);
		$email = $this->request->getPost('email');
		$pass = md5($this->request->getPost('password'));


		$user = $this->userModel->where('email', $email)->first();
		// dd($user['password']);
		if ($user) {
			if ($user['password'] !== $pass) {
				$this->notif->pesan('password tidak sesuai', 'danger');
				return redirect()->to('/auth')->withInput();
			} else {
				$level = $user['status'];
				$setData = [
					'status' => $user['status'],
					'nama' => $user['namadepan'],
					'isLoggedIn' => true,
				];
				$this->session->set($setData);
				//role untuk admin
				if ($level === '1') {
					return redirect()->to(base_url('/dashboard'));
				} else {
					return redirect()->to(base_url('/'));
				}
			}
		} else {
			$this->notif->pesan('user tidak ditemukan', 'danger');
			return redirect()->to('/auth');
		}
	}

	public function fregister()
	{
		$data = [
			'validation' => \Config\Services::validation()
		];
		return view('Auth/register', $data);
	}

	public function register()
	{

		//validasi input
		if (!$this->validate([
			'email' => [
				'rules' => 'required|is_unique[users.email]',
				'errors' => [
					'required' => '{field}  harus disi',
					'is_unique' => '{field}  sudah terdaptar'
				]
			],
			'namadepan' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field}  harus disi',
				]
			],
			'notelpon' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field}  harus disi',
				]
			],
			'tgllahir' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field}  harus disi',
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field}  harus disi',
				]
			],
			'repassword' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => '{field}  harus disi',
					'matches' => '{field} tidak sama dengan password'
				]
			],
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to('/register')->withInput()->with('validation', $validation);
		}

		//definisi data
		$pass = md5($this->request->getPost('password'));
		$data = [
			'email' => $this->request->getPost('email'),
			'namadepan' => $this->request->getPost('namadepan'),
			'namabelakang' => $this->request->getPost('namabelakang'),
			'notelpon' => $this->request->getPost('notelpon'),
			'password' => $pass,
			'tgllahir' => $this->request->getPost('tgllahir'),
			'tglregister' => $this->now,
			'status' => '2',
		];

		//insert data
		$this->userModel->save($data);
		$this->notif->pesan('registrasi berhasil, silahkan login', 'info');
		return redirect()->to('/auth');
	}

	function logout()
	{
		$this->session->destroy();
		return redirect()->to(base_url('/'));
	}


	//--------------------------------------------------------------------

}
