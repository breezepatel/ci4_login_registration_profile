<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $data =[];
     
        $model = new UserModel();
        $data['user'] = $model->where('id', session()->get('id'))->first();

        echo view('header', $data);
		echo  view('dashboard');
		echo view('footer');
        
    }
}
