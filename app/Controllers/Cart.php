<?php

namespace App\Controllers;

use App\Models\Products_m;

class Cart extends BaseController
{
    protected $prod;
    public function __construct()
    {
        $this->prod = new Products_m();
        $this->session = session();
    }


    public function index()
    {
    }

    public function addCart($id)
    {
        $pr = $this->prod->find($id);
        $items = [
            'id' => $pr['id'],
            'nama' => $pr['nama'],
            'hrgjual' => $pr['hrgjual'],
            'image' => $pr['image'],
            'qty' => 1,
        ];

        if ($this->session->has('cart')) {
            $index = $this->exist_id($id);
            $cart = $this->session->get('cart');
            if ($index == -1) {
                array_push($cart, $items);
            } else {
                $cart[$index]['qty']++;
            }
            $this->session->set('cart', $cart);
        } else {
            $cart = array($items);
            $this->session->set('cart', $cart);
        }
        // dd($this->session->get('cart'));
        return $this->response->redirect('/');
    }

    public function remove($id)
    {
        $index = $this->exist_id($id);
        $cart = $this->session->get('cart');
        // dd($cart);
        unset($cart[$index]);
        $this->session->set('cart', $cart);
        return $this->response->redirect('/');
    }

    private function exist_id($id)
    {
        $items = $this->session->get('cart');
        for ($i = 0; $i < count($items); $i++) {
            if ($items[$i]['id'] == $id) {
                return $i;
            }
        }
        return -1;
    }

    function total()
    {
        $s = 0;
        $cart = $this->session->get('cart');
        foreach ($cart as $item) {
            $s += $item['qty'] * $item['hrgjual'];
        }
        return $s;
    }
}