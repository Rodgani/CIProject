<?php

namespace App\Models\User;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'username',
        'password',
        'responsibility_id',
    ];
    

    public function getUser(string $username, string $password)
    {
        $user = $this
            ->asArray()
            ->where([
                'username' => $username,
                'password' => $password
                ])
            ->first();

        if (!$user)
            throw new Exception('Username or Password Incorrect');

            return $user;
    }

}
