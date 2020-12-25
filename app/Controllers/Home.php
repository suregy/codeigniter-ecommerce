<?php

namespace App\Controllers;

use App\Models\Banners_m;
use App\Models\Category_m;
use App\Models\Brands_m;
use App\Models\Products_m;
use App\Models\Detprod_m;

class Home extends BaseController
{
	protected $banners;
	protected $cat;
	protected $br;
	protected $pr;
	protected $det;


	public function __construct()
	{
		$this->banners = new Banners_m();
		$this->cat = new Category_m();
		$this->br = new Brands_m();
		$this->pr = new Products_m();
		$this->det = new Detprod_m();
		$this->session = session();
	}

	public function index()
	{
		$data = [
			'banners' => $this->banners->findAll(),
			'count' =>  $this->session->get('cart'),
		];
		// dd($data['count']);
		return view('index', $data);
	}

	public function category($type)
	{
		//untuk type, cewek atau cowok atau anak
		$c1 = $type == 'pria' ? '1' : ($type == 'wanita' ? '2' : ($type == 'anak'  ? '3' : '4'));

		$test = isset($_GET['sort']) ? $_GET['sort'] : '';
		$surt = $test > 1 ? 'desc' : 'asc';

		if (isset($_GET['brand'])) {
			$brand = $_GET['brand'];
		} else {
			$brand = null;
		}
		if (isset($_GET['cat'])) {
			$cat = $_GET['cat'];
		} else {
			$cat = null;
		}
		$data = [
			'c2' => $this->cat->countcat($c1),
			'brands' => $this->br->findAll(),
			'produk' => $this->pr->shop($brand, $cat)->where('c1', $c1)->orderBy('hrgjual', $surt)->paginate(2, 'products'),
			'pager' => $this->pr->pager,
		];

		switch ($type) {
			case 'pria':
				return view('shop', $data);
				break;
			case 'wanita':
				return view('shop', $data);
				break;
			case 'anak':
				return view('shop', $data);
				break;
			case 'aksesoris':
				return view('shop', $data);
				break;
			default:
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
				break;
		}
	}

	public function produk($slug)
	{
		$data = [
			'details' => $this->pr->detail($slug)
		];
		// dd($data['details']);


		return view('proddetail', $data);
	}


	//--------------------------------------------------------------------

}