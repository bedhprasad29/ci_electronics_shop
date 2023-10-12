<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\User as UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $user = new UserModel;
        
        return $this->respond($user->getUserAll());
    }

    public function create()
    {
        helper('common');
        $currentUser = getCurrentUser($this->request);

        $attributes = $this->getRequestInput($this->request);

        $user = new UserModel;

        if (!$this->validateRequest($attributes, $user->validationRules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $attributes['created_by']= $currentUser['id'];
        $attributes['updated_by']= $currentUser['id'];

        $user->save($attributes);

        return $this->respondCreated(['message' => 'User created successfully']);
    }

    public function show($id = NULL)
    {
        $user = new UserModel;

        return $this->respond($user->getUserOne($id));
    }

    public function update($id = NULL)
    {
        helper('common');
        $currentUser = getCurrentUser($this->request);

        $user = new UserModel;
        $attributes = $this->getRequestInput($this->request);
        $attributes['id'] = $id;

        $rules = $user->validationRules;
        unset($rules['role_id']);
        unset($rules['password']);

        if (!$this->validateRequest($attributes, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $data = [
            'username'  => $attributes['username'],
            'email'     => $attributes['email'],
            'updated_by'=> $currentUser['id']
        ];
        $db = db_connect();
        $builder = $db->table('users');
        $builder->where('id', $id);
        $builder->update($data);
        
        if($id) {
            $pattributes['updated_by'] = 1;
            $pattributes['dob'] = $attributes['dob'];
            $pattributes['mobile'] = $attributes['mobile'];
            $pattributes['state'] = $attributes['state'];
            $pattributes['address'] = $attributes['address'];
            $pattributes['pincode'] = $attributes['pincode'];

            $db = db_connect();
            $builder = $db->table('user_personals');
            $builder->where('user_id', $id);
            $builder->update($pattributes);
        }

        return $this->respond(['message' => 'User updated successfully']);
    }

    public function delete($id = NULL)
    {
        $user = new UserModel();
        $data = $user->find($id);
        if($data) {
            $user->delete($id);
            return $this->respondDeleted(['message' => 'User deleted successfully']);
        } else {
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
}
