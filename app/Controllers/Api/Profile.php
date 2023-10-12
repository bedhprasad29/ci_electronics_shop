<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\User as UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    use ResponseTrait;

    public function reset($id = NULL)
    {
        $attributes = $this->getRequestInput($this->request);

        $rules = [
            'password'          => 'required|min_length[6]|max_length[255]',
            'confirm_password'  => 'required|matches[password]'
        ];
        
        if (!$this->validateRequest($attributes, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $data = [
            'password' => password_hash($attributes['password'], PASSWORD_BCRYPT)
        ];

        $profile = new UserModel;
        $profile->update($id, $data);

        return $this->respond(['message' => 'Password reset successfully']);
    }
}
