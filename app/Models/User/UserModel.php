<?php

namespace App\Models\User;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'iis_employee_number',
        'email',
        'password',
        'responsibility',
    ];
    
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }

    public function getUser(string $email)
    {
        $user = $this
            ->asArray()
            ->where([
                'email' => $email,
                // 'password' => $password
                ])
            ->first();

        if (!$user)
            throw new Exception('Email or Password Incorrect');

            return $user;
    }

    public function getUserById(string $id)
    {
        $user = $this
            ->asArray()
            ->where([
                'id' => $id
                ])
            ->first();

        if (!$user)
            throw new Exception('Email or Password Incorrect');

            return $user;
    }

}
