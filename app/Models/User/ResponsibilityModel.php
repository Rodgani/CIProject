<?php

namespace App\Models\User;

use CodeIgniter\Model;
use Exception;

class ResponsibilityModel extends Model
{
    protected $table = 'responsibility';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'responsibility_name',
        'responsibility_ff',
    ];
    
    public function getResById(string $id)
    {
        $res = $this
            ->asArray()
            ->where([
                'id' => $id
                ])
            ->first();

        if (!$res)
            throw new Exception('Email or Password Incorrect');

            return $res;
    }
}
