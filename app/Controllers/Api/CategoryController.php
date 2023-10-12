<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\Category as CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $category = new CategoryModel;
        
        return $this->respond($category->findAll());
    }

    public function create()
    {
        helper('common');
        $currentUser = getCurrentUser($this->request);

        $attributes = $this->getRequestInput($this->request);

        $category = new CategoryModel;
        
        if (!$this->validateRequest($attributes, $category->validationRules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $attributes['created_by']= $currentUser['id'];
        $attributes['updated_by']= $currentUser['id'];

        $category->save($attributes);

        return $this->respondCreated(['message' => 'Category created successfully']);
    }

    public function show($id = NULL)
    {
        $category = new CategoryModel;

        return $this->respond($category->find($id));
    }

    public function update($id = NULL)
    {
        helper('common');
        $currentUser = getCurrentUser($this->request);

        $category = new CategoryModel;
        $attributes = $this->getRequestInput($this->request);
        $attributes['id'] = $id;

        if (!$this->validateRequest($attributes, $category->validationRules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $data = [
            'name'      => $attributes['name'],
            'status'    => $attributes['status'],
            'updated_by'=> $currentUser['id']
        ];

        $category->update($id, $data);

        return $this->respond(['message' => 'Category updated successfully']);
    }

    public function delete($id = NULL)
    {
        $category = new CategoryModel();
        $data = $category->find($id);
        if($data) {
            $category->delete($id);
            return $this->respondDeleted(['message' => 'Category deleted successfully']);
        } else {
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
}
