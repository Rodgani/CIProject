<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class HomeController extends BaseController
{

	public function index()
	{
        $view = "Home";
		$data[''] = null;
        $layout = $this->Layout($view,$data);
	}

}
