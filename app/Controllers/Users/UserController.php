<?php

namespace App\Controllers\Users;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use App\Controllers\BaseController;

class UserController extends BaseController
{

	public function index()
	{
		$view = "User/UserView";
        $layout = $this->Layout($view);
	}

}
