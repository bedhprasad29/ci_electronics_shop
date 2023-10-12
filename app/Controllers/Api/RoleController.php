<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\Role as RoleModel;
use CodeIgniter\HTTP\ResponseInterface;

class RoleController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $role = new RoleModel;

        return $this->respond($role->findAll());
    }

    public function create()
    {
        // get current logged in user data
        helper('common');
        $currentUser = getCurrentUser($this->request);

        $attributes = $this->getRequestInput($this->request);

        $role = new RoleModel;

        if (!$this->validateRequest($attributes, $role->validationRules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $attributes['created_by']= $currentUser['id'];
        $attributes['updated_by']= $currentUser['id'];

        $role->save($attributes);

        return $this->respondCreated(['message' => 'Role created successfully']);
    }

    public function show($id = NULL)
    {
        $role = new RoleModel;

        return $this->respond($role->find($id));
    }

    public function update($id = NULL)
    {
        helper('common');
        $currentUser = getCurrentUser($this->request);

        $role = new RoleModel;
        $attributes = $this->getRequestInput($this->request);
        $attributes['id'] = $id;

        if (!$this->validateRequest($attributes, $role->validationRules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $data = [
            'name'      => $attributes['name'],
            'status'    => $attributes['status'],
            // 'updated_by'=> $currentUser['id']
        ];

        $role->update($id, $data);

        return $this->respond(['message' => 'Role updated successfully']);
    }

    public function delete($id = NULL)
    {
        $role = new RoleModel();
        $data = $role->find($id);
        if($data) {
            $role->delete($id);
            return $this->respondDeleted(['message' => 'Role deleted successfully']);
        } else {
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
}
