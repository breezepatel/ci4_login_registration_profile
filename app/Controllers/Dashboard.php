<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data =[];
        echo view('header', $data);
		echo  view('dashboard');
		echo view('footer');
        
    }
}
