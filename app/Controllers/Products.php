<?php namespace App\Controllers;

use App\Models\Products_m;
use App\Models\Category_m;

class Products extends BaseController
{
    protected $product;
    protected $category;
	protected $helpers;
	
	public function __construct(){
        $this->product = new Products_m();
        $this->category = new Category_m();
        helper(['rupiah_helper','form']);
	}

	public function index()
	{
		
		$judul = [
            'judul' => 'Data Product',
			'c1' => $this->category->getC1(),
		];
		return view('Admin/Product/index',$judul);
    }
    
    function getData(){
        if($this->request->isAJAX()){
			$c1 = $this->request->getVar('c1');
			$c2 = $this->request->getVar('c2');
			$c3 = $this->request->getVar('c3');
			if(empty($c1)){
				$tampil = $this->product->joinBrand();
			} 
			if(!empty($c1)){
				$tampil = $this->product->filter($c1);
			}
			if(!empty($c2)){
				$tampil = $this->product->filter($c1,$c2);
			}
			if(!empty($c3)){
				$tampil = $this->product->filter($c1,$c2,$c3);
			}
			$data = [
				'tampildata' => $tampil,
			];
			$json = [
				'data' => view('Admin/Product/table',$data),
			];

			echo json_encode($json);

		}else{
			exit('maaf tidak dapat diproses');
		}
	}
	
	function getC2(){
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

	function getC3(){
		if($this->request->isAJAX()){
			$c1 = $this->request->getVar('c1');
			$c2 = $this->request->getVar('c2');
			$json = [	
				'c3' => $this->category->getC3($c1,$c2)
			];

			echo json_encode($json);
		}else{
			exit('maaf tidak dapat diproses');
		}
	}

}