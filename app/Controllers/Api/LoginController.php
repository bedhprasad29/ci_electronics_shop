<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\UserPersonal;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;

class LoginController extends BaseController
{
    public function index()
    {
        //
    }

    /**
     * Authenticate Existing User
     * @return Response
     */
    public function doSignIn()
    {
        $rules = [
            'email'     => 'required|min_length[6]|max_length[50]|valid_email',
            'password'  => 'required|min_length[6]|max_length[255]|validateUser[email, password]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $attributes = $this->getRequestInput($this->request);

        if (!$this->validateRequest($attributes, $rules, $errors)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $this->setSessionForUser($attributes['email']);

        return $this->getJWTForUser($attributes['email']);
    }

    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
    public function doSignUp()
    {
        $rules = [
            'username'          => 'required|is_unique[users.username]|regex_match[/^\S*$/]|max_length[65]',
            'email'             => 'required|min_length[6]|max_length[65]|valid_email|is_unique[users.email]',
            'password'          => 'required|min_length[6]|max_length[255]',
            'dob'               => 'required|valid_date',
            'mobile'            => 'required|numeric|exact_length[10]',
            'state'             => 'required|alpha|max_length[55]',
            'address'           => 'required|max_length[255]',
            'confirm_password'  => 'required|matches[password]',
            'pincode'           => 'required|numeric|exact_length[6]',
        ];

        $attributes = $this->getRequestInput($this->request);
        if (!$this->validateRequest($attributes, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $attributes['password']      = password_hash($attributes['password'], PASSWORD_BCRYPT);
        $attributes['role_id']       = 4;
        $userModel = new User();
        $user = $userModel->insert($attributes);
        if($user) {
            $pattributes['user_id']     = $user;
            $pattributes['dob']         = $attributes['dob'];
            $pattributes['mobile']      = $attributes['mobile'];
            $pattributes['state']       = $attributes['state'];
            $pattributes['address']     = $attributes['address'];
            $pattributes['pincode']     = $attributes['pincode'];
            $pattributes['updated_by']  = 1;

            $db = db_connect();
            $builder = $db->table('user_personals');
            $builder->insert($pattributes);

            $this->setSessionForUser($attributes['email']);

            return $this->getJWTForUser($attributes['email'], ResponseInterface::HTTP_CREATED);
        }
        // if($user) {
        //     $userPersonalModel = new UserPersonal();
        //     $attributes['user_id']       = $user;
        //     $attributes['created_by']    = $user;
        //     $userPersonal = $userPersonalModel->save($attributes);

            
        // }
    }

    private function setSessionForUser(string $emailAddress)
    {
        $session = session();
        
        // Get user detail
        $user = new User;
        $user = $user->where('email', $emailAddress)->first();

        $newdata = [
            'id'        => $user['id'],
            'email'     => $emailAddress,
            'name'      => $user['username'],
            'role_id'   => $user['role_id'],
            'logged_in' => true,
        ];
        $session->set('user_data', $newdata);
    }

    private function getJWTForUser(
        string $emailAddress,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        try {
            $model = new User();
            $user = $model->findUserByEmailAddress($emailAddress);
            unset($user['password']);

            helper('jwt');

            return $this->getResponse([
                'message'       => 'User authenticated successfully',
                // 'user'          => $user,
                'access_token'  => getSignedJWTForUser($user['id'], $emailAddress, $user['role_id'])
            ]);
        } catch (Exception $exception) {
            return $this->getResponse([
                'error' => $exception->getMessage(),
            ], $responseCode);
        }
    }
}
