<?php

namespace App\Controllers;
use App\Models\User\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;
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
		
		 $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email, password]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }
	
		try{
			$model = new UserModel();
			$user = $model->getUser($input['email']);

			$_SESSION['responsibility'] = $user['responsibility'];
			$_SESSION['iis_employee_number'] = $user['iis_employee_number'];
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
				
			$array_items = ['iis_employee_number','responsibility','login'];
			$this->session->remove($array_items);

			//$this->session->sess_destroy();
			return redirect()->route('/');
		} 
	
	}
}
