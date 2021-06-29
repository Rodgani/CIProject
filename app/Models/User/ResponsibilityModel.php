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
    
}
