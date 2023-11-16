<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class User extends BaseController
{
    protected $UserModel;
    protected $RoleModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->RoleModel = new RoleModel();
        helper('number');
    }

    public function update($id)
    {
        $this->RoleModel->save([
            'user_id'   => $id,
            'group_id'  => $this->request->getVar('role')
        ]);

        session()->setFlashdata('message', 'Data berhasil diedit!');

        return redirect()->to('/admin/user');
    }

    public function delete($id)
    {
        $this->UserModel->delete($id);

        session()->setFlashdata('message', 'Data berhasil terhapus!');

        return redirect()->to('/admin/user');
    }
}
