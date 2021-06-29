<?php

namespace App\Models\User;

use CodeIgniter\Model;
use Exception;

class ModulesModel extends Model
{
    protected $table = 'form_function';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'form_function',
        'code',
    ];
    
}