<?php

namespace App\Controllers;
use App\Models\M_Tempat;

class Home extends BaseController
{
    public function __construct()
    {
        $this->Tempat = new M_Tempat();
    }

    public function index()
    {
        $tempat = $this->Tempat->get();
        $data = [
            'title' => 'Admin | Home',
            'tempats' => $tempat->getResult('array')
        ];
        return view('index', $data);
    }

    public function addTempat()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'longitude' => $this->request->getPost('longitude'),
            'latitude' => $this->request->getPost('latitude')
        ];

        $this->Tempat->insert($data);
        return redirect()->back();
    }
}
