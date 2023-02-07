<?php

namespace App\Controllers;

use App\Models\UserModel;


class Users extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);


		if ($this->request->getPost()) {
			// Login validation here
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if (!$this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();

				$user = $model->where('email', $this->request->getVar('email'))
					->first();

				$this->setUserSession($user);
				return redirect()->to('dashboard');
			}
		}

		echo view('header', $data);
		echo view('login');
		echo view('footer');
	}

	private function setUserSession($user)
	{
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'age' => $user['age'],
			'gender' => $user['gender'],
			'profile_image' => $user['profile_image'],

			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function register()
	{

		$data = [];
		helper(['form']);


		if ($this->request->getPost()) {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[loginuser.email]',
				'age' => 'required|less_than[100]|greater_than[0]',
				'gender' => 'required',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];

			if (!$this->validate($rules)) {

				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();

				$newData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email'),
					'age' => $this->request->getVar('age'),
					'gender' => $this->request->getVar('gender'),
					'password' => $this->request->getVar('password'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Successful Registration',3);
				return redirect()->to('/');
			}
		}


		echo view('header', $data);
		echo view('register');
		echo view('footer');
	}


	public function profile($edit = null)
	{

		$data = [];
		helper(['form']);
		$model = new UserModel();

		if ($this->request->getPost()) {
			//let's do the validation here
			if ($edit == 'details') {
				$rules = [
					'firstname' => 'required|min_length[3]|max_length[20]',
					'lastname' => 'required|min_length[3]|max_length[20]',
					'age' => 'required|less_than[100]|greater_than[0]',
					'gender' => 'required',
				];
				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$newData = [
						'id' => session()->get('id'),
						'firstname' => $this->request->getPost('firstname'),
						'lastname' => $this->request->getPost('lastname'),
						'age' => $this->request->getPost('age'),
						'gender' => $this->request->getPost('gender'),
					];
					$model->save($newData);
					session()->setFlashdata('success', 'Successfuly Updated',3);
					return redirect()->to('/profile');
				}
			} elseif ($edit == "password") {
				$rules = [
					'password' => 'required|min_length[8]|max_length[255]',
					'password_confirm' => 'matches[password]',
				];
				if (!$this->validate($rules)) {
					$data['validation'] = $this->validator;
				} else {
					$newData = [
						'id' => session()->get('id'),
						'password' => $this->request->getPost('password')
					];

					$model->save($newData);
					session()->setFlashdata('success', 'Successfuly Password Changed',3);
					return redirect()->to('/profile');
				}
			} elseif ($edit == "image") {
				
				$rules = [
					'profile_image' => 'uploaded[profile_image]|max_size[profile_image,1024]|ext_in[profile_image,png,jpg,gif,jpeg,jfif]',
				];
				
				if (!$this->validate($rules)) {
				
					$data['validation'] = $this->validator;
				
				} else {
					$file = $this->request->getFile('profile_image');
					if ($file->isValid() && !$file->hasMoved()) {
						if ($file->move(FCPATH . 'public\profiles', $file->getRandomName())) {

							$path = base_url() . '/public/profiles/' . $file->getName();
							$newData = [
								'id' => session()->get('id'),
								'profile_image' => $path,
							];

							$model->save($newData);
							session()->setFlashdata('success', 'Successfuly Profile Photo Uploaded',3);
							return redirect()->to('/profile');
						}
					}
				}
			}
		}
		$data['user'] = $model->where('id', session()->get('id'))->first();

		echo view('header', $data);
		echo view('profile');
		echo view('footer');
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}

	public function delete()
	{		
		$model = new UserModel();
		$session = session();
 		$id = session()->get('id');

		$model->delete($id);
		session()->destroy();
		return redirect()->to('/');	}
}


// profile validation
// $rules = [
// 	'firstname' => 'required|min_length[3]|max_length[20]',
// 	'lastname' => 'required|min_length[3]|max_length[20]',
// 	'age' => 'required|less_than[100]|greater_than[0]',
// 	'gender' => 'required',
// ];

// if ($this->request->getPost('password') != '') {
// 	$rules['password'] = 'required|min_length[8]|max_length[255]';
// 	$rules['password_confirm'] = 'matches[password]';
// }


// if (!$this->validate($rules)) {
// 	$data['validation'] = $this->validator;
// } else {
// 	$newData = [
// 		'id' => session()->get('id'),
// 		'firstname' => $this->request->getPost('firstname'),
// 		'lastname' => $this->request->getPost('lastname'),
// 		'age' => $this->request->getPost('age'),
// 		'gender' => $this->request->getPost('gender'),
// 	];

// 	if ($this->request->getPost('password') != '') {
// 		$newData['password'] = $this->request->getPost('password');
// 	}

// 	$model->save($newData);

// 	session()->setFlashdata('success', 'Successfuly Updated');
// 	return redirect()->to('/profile');

