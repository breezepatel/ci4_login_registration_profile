<?php

namespace App\Controllers;

use App\Models\UserModel;

class Listall extends BaseController
{
    public function index() {
        $session = \Config\Services::session();
        $data['session'] = $session;


        $model = new UserModel();
        $data['user'] = $model->where('id', session()->get('id'))->first();
        
        $model = new UserModel();
        $data['registered'] = $model->paginate(2);
        $data['pager'] = $model->pager;

        // $data['registered'] = $registerArray;
        
        echo view('header');
		echo  view('listall', $data);
		echo view('footer');
    }


    public function search() {
        $data=[];
        $model = new UserModel();

        if($this->request->getPost()){
          
            $keyword=$this->request->getPost('keyword');
            $data['registered'] = $model->search($keyword);
        }
        // $data['registered'] = $registerArray;
        
        echo view('header');
		echo  view('filterlistall', $data);
		echo view('footer');
    }
}
