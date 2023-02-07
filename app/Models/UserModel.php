<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'loginuser';
  protected $allowedFields = ['firstname', 'lastname', 'email', 'age', 'gender', 'profile_image', 'password', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  public function getRecords()
  {
    return $this->orderBy('id', 'DESC')->findAll();
  }

  public function search($keyword)
  {
    $this->like('firstname',$keyword);
    $this->like('firstname',$keyword);

    return $this->get('user')->result_array();
  }

  protected function beforeInsert(array $data)
  {
    $data = $this->passwordHash($data);
    $data['data']['created_at'] = date('Y-m-d H:i:s');

    return $data;
  }

  protected function beforeUpdate(array $data)
  {
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function passwordHash(array $data)
  {
    if (isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }
}
