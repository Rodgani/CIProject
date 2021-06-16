<?php

namespace App\Controllers;
use App\Models\User\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class LoginController extends BaseController
{

	public function index()
	{
		if(isset($_SESSION['login'])){
			return redirect()->route('Home');
        }
		return view('Login/LoginView');
	}

	public function Login(){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		try{
			$model = new UserModel();
			$user = $model->getUser($username,$password);

			$_SESSION['responsibility_id'] = $user['responsibility_id'];
			$_SESSION['user_id'] = $user['user_id'];
            $_SESSION['login'] = TRUE;
			
			return $this
			->getResponse(
				[
					'message' => 'User authenticated successfully',
					'user' => $user
				]
			);
			// echo print_r($user);
		}catch (Exception $exception) {
			return $this
			->getResponse(
				[
					'error' => $exception->getMessage(),
				],
			);
		}
	}
	
	public function Logout(){
		
		if(isset($_SESSION['login'])){
				
			$array_items = ['name', 'user_id','responsibility_id','login'];
			$this->session->remove($array_items);

			//$this->session->sess_destroy();
			return redirect()->route('/');
		} 
	
	}
}
