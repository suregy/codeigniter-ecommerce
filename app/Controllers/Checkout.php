<?php

namespace App\Controllers;

use App\Models\Products_m;

class Checkout extends BaseController
{
    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "25590c47852d82eb4afa00138b928a02";
    function __construct()
    {
    }

    public function index()
    {
        $province = $this->rajaongkir('province');
        $data = [
            'provinsi' => json_decode($province)->rajaongkir->results,
        ];
        return view('Checkout', $data);
    }

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;
        //jika id prov not null
        if ($id_province != null) {
            $endPoint = $endPoint . "?province=" . $id_province;
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    public function getKota()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getVar('idprov');
            $data = $this->rajaongkir('city', $id_province); //untuk select kab
            return $this->response->setJSON($data);
        }
    }

    private function rajaongkirgetcost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key:" . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }

    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getVar('origin');
            $destination = $this->request->getVar('destination');
            $weight = $this->request->getVar('weight');
            $courier = $this->request->getVar('courier');
            $data = $this->rajaongkirgetcost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }
}
