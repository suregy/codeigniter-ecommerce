<?php

namespace App\Controllers;

use App\Models\Banners_m;
use App\Models\Category_m;
use App\Models\Brands_m;
use App\Models\Products_m;

class Home extends BaseController
{
	protected $banners;
	protected $cat;
	protected $br;
	protected $pr;

	public function __construct()
	{
		$this->banners = new Banners_m();
		$this->cat = new Category_m();
		$this->br = new Brands_m();
		$this->pr = new Products_m();
	}

	public function index()
	{
		$data = [
			'banners' => $this->banners->findAll()
		];
		return view('index', $data);
	}

	public function category($type)
	{
		if (isset($_GET['sort'])) {
			$sort = $_GET['sort'];
		} else {
			$sort = "ASC";
		}
		if (isset($_GET['brand'])) {
			$brand = $_GET['brand'];
		} else {
			$brand = null;
		}
		$data = [
			'brands' => $this->br->findAll(),
			'produk' => $this->pr->shop($brand)->orderBy('hrgjual', $sort)->paginate(12, 'products'),
			'pager' => $this->pr->pager,
		];
		switch ($type) {
			case 'pria':
				return view('shop', $data);
				break;
			case 'wanita':
				# code...
				break;
			case 'anak':
				# code...
				break;
			case 'aksesoris':
				# code...
				break;

			default:
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				break;
		}
	}


	//--------------------------------------------------------------------

}