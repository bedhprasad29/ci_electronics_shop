<?php

use App\Models\User;
use Config\Services;
use Firebase\JWT\JWT;

function getJWTFromRequest(string $authenticationHeader)
{
    if (is_null($authenticationHeader)) { //JWT is absent
        throw new Exception('Missing or invalid JWT in request');
    }
    //JWT is sent from client in the format Bearer XXXXXXXXX
    return explode(' ', $authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodedToken)
{
    $key = Services::getSecretKey();
    $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
    $userModel = new User();
    $userModel->findUserByEmailAddress($decodedToken->email);
}

function getSignedJWTForUser(string $id, string $email, string $roleId)
{
    $issuedAtTime = time();
    $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
    $payload = [
        'id'        => $id,
        'email'     => $email,
        'role_id'   => $roleId,
        'iat'       => $issuedAtTime,
        'exp'       => $tokenExpiration,
    ];

    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'));
    return $jwt;
}

function getDecodedJWTForUser(string $token)
{
    $key = getenv('JWT_SECRET_KEY');

    $decoded = JWT::decode($token, $key, ['HS256']);
    $response = [
        'id'        => $decoded->id,
        'email'     => $decoded->email,
        'role_id'   => $decoded->role_id
    ];
    return $response;
}
