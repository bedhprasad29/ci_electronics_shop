<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\Product as ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $product = new ProductModel;

        return $this->respond($product->getProductAll());
    }

    public function create()
    {
        // get current logged in user data
        helper('common');
        $currentUser = getCurrentUser($this->request);

        $attributes = $this->getRequestInput($this->request);
        
        $product = new ProductModel;

        if (!$this->validateRequest($attributes, $product->validationRules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $attributes['created_by']= $currentUser['id'];
        $attributes['updated_by']= $currentUser['id'];

        $product->save($attributes);

        return $this->respondCreated(['message' => 'Product created successfully']);    
    }

    public function show($id = NULL)
    {
        $product = new ProductModel;

        return $this->respond($product->getProductOne($id));
    }

    public function update($id = NULL)
    {
        helper('common');
        $currentUser = getCurrentUser($this->request);

        $product = new ProductModel;
        $attributes = $this->getRequestInput($this->request);
        $attributes['id'] = $id;

        if (!$this->validateRequest($attributes, $product->validationRules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $data = [
            'name'          => $attributes['name'],
            'category_id'   => $attributes['category_id'],
            'description'   => $attributes['description'],
            'price'         => $attributes['price'],
            'status'        => $attributes['status'],
            'updated_by'    => $currentUser['id']
        ];

        $product->update($id, $data);

        return $this->respond(['message' => 'Product updated successfully']);
    }

    public function delete($id = NULL)
    {
        $product = new ProductModel();
        $data = $product->find($id);
        if($data) {
            $product->delete($id);
            return $this->respondDeleted(['message' => 'Product deleted successfully']);
        } else {
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
}
