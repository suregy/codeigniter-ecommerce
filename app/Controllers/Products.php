<?php

namespace App\Controllers;

use App\Models\Products_m;
use App\Models\Category_m;
use App\Models\Brands_m;
use App\Models\Tags_m;
use App\Models\Tagsdet_m;
use App\Models\Imageprod_m;

class Products extends BaseController
{
	protected $product;
	protected $category;
	protected $brands;
	protected $tags;
	protected $tagsdet;
	protected $image;
	protected $helpers;

	public function __construct()
	{
		$this->product = new Products_m();
		$this->category = new Category_m();
		$this->brands = new Brands_m();
		$this->tags = new Tags_m();
		$this->tagsdet = new Tagsdet_m();
		$this->image = new Imageprod_m();
		helper(['rupiah_helper', 'form']);
	}

	public function index()
	{
		$judul = [
			'judul' => 'Data Product',
			'c1' => $this->category->getC1(),
		];
		return view('Admin/Product/index', $judul);
	}

	function getData()
	{
		if ($this->request->isAJAX()) {
			$c1 = $this->request->getVar('c1');
			$c2 = $this->request->getVar('c2');
			$c3 = $this->request->getVar('c3');
			if (empty($c1)) {
				$tampil = $this->product->joinBrand();
			}
			if (!empty($c1)) {
				$tampil = $this->product->filter($c1);
			}
			if (!empty($c2)) {
				$tampil = $this->product->filter($c1, $c2);
			}
			if (!empty($c3)) {
				$tampil = $this->product->filter($c1, $c2, $c3);
			}
			$data = [
				'tampildata' => $tampil,
			];
			$json = [
				'data' => view('Admin/Product/table', $data),
			];

			echo json_encode($json);
		} else {
			exit('maaf tidak dapat diproses');
		}
	}

	function getC2()
	{
		if ($this->request->isAJAX()) {
			$c1 = $this->request->getVar('c1');
			$json = [
				'c2' => $this->category->getC2($c1)
			];

			echo json_encode($json);
		} else {
			exit('maaf tidak dapat diproses');
		}
	}

	function getC3()
	{
		if ($this->request->isAJAX()) {
			$c1 = $this->request->getVar('c1');
			$c2 = $this->request->getVar('c2');
			$json = [
				'c3' => $this->category->getC3($c1, $c2)
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
				'data' => view('Admin/Product/formTambah'),
				'c1' => $this->category->getC1(),
				'brands' => $this->brands->findAll(),
				'tags' => $this->tags->findAll(),
			];
			echo json_encode($json);
		} else {
			exit('maaf tidak dapat diproses');
		}
	}

	function store()
	{
		if ($this->request->isAJAX()) {
			$judul = $this->request->getVar('nama');
			$slug = url_title($judul, '-', true);
			$data = [
				'c1' => $this->request->getVar('cmbcat1'),
				'c2' => $this->request->getVar('cmbcat2'),
				'c3' => $this->request->getVar('cmbcat3'),
				'idbrand' => $this->request->getVar('cmbbrands'),
				'nama' => $this->request->getVar('nama'),
				'slug' => $slug,
				'deskripsi' => $this->request->getVar('desc'),
				'hrgbeli' => $this->request->getVar('hrgbeli'),
				'hrgjual' => $this->request->getVar('hrgjual'),
			];
			$tags = $this->request->getVar('tags');


			$insert = $this->product->store($data);
			if ($insert) {
				if (!empty($tags)) {
					foreach ($tags as $t) {
						$this->tagsdet->insert([
							'idproduct' => $insert,
							'idtags' => $t
						]);
					}
				}

				if ($imagefile = $this->request->getFiles()) {
					foreach ($imagefile['fileMulti'] as $img) {
						if ($img->isValid() && !$img->hasMoved()) {
							$randomName = $img->getRandomName();
							$this->image->insert([
								'idproduct' => $insert,
								'file' => $randomName,
							]);
							$img->move('images/products', $randomName);
						}
					}
				}
			}

			$json = [
				'sukses' => 'data berhasil disimpan',

			];
			echo json_encode($json);
		} else {
			exit('maaf tidak dapat diproses');
		}
	}

	//--------------------end line
}