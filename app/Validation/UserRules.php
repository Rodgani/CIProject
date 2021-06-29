<?php

namespace App\Validation;

use App\Models\User\UserModel;
use Exception;

class UserRules
{
    public function validateUser(string $str, string $fields, array $data): bool
    {
        try {
            $model = new UserModel();
            $user = $model->getUser($data['email']);
            $hash = $user['password'];
            return password_verify($data['password'], $hash);
        } catch (Exception $e) {
            return false;
        }
    }
}
