<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Validation\Exceptions\ValidationException;
use Config\Services;
use App\Models\User\ResponsibilityModel;
use App\Models\User\ModulesModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->session = \Config\Services::session();
		$this->session->start();
		$this->security = \Config\Services::security();

	}

	public function getRequestInput(IncomingRequest $request){
        $input = $request->getPost();
        if (empty($input)) {
            //convert request body to associative array
            $input = json_decode($request->getBody(), true);
        }
        return $input;
    }
	
    public function validateRequest($input, array $rules, array $messages = []){
        $this->validator = Services::Validation()->setRules($rules);
        // If you replace the $rules array with the name of the group
        if (is_string($rules)) {
            $validation = config('Validation');

            // If the rule wasn't found in the \Config\Validation, we
            // should throw an exception so the developer can find it.
            if (!isset($validation->$rules)) {
                throw ValidationException::forRuleNotFound($rules);
            }

            // If no error message is defined, use the error message in the Config\Validation file
            if (!$messages) {
                $errorName = $rules . '_errors';
                $messages = $validation->$errorName ?? [];
            }

            $rules = $validation->$rules;
        }
        return $this->validator->setRules($rules, $messages)->run($input);
    }

	public function getResponse(array $responseBody,
		int $code = ResponseInterface::HTTP_OK)
	{
		return $this
		->response
		->setStatusCode($code)
		->setJSON($responseBody);
	}

	public function Layout($path,$data){
        
        if(!isset($_SESSION['login'])){
			echo "<script>window.location.href='".base_url()."'</script>";
        }else{

			$sidebar['ff_responsibility'] = $this->getFFResponsibility();

            echo view('Layout/Header');
			echo view('Layout/Sidebar',$sidebar);
			echo view($path,$data);
            echo view('Layout/Footer');
			
        }
    }

	public function isAllowed($code){
		// check if code is in the responsibility array of le user
		$responsibility_id = $_SESSION['responsibility'];
		$builder = new ResponsibilityModel();
		$builder->where('id',$responsibility_id);
		$getRes = $builder->get()->getRowArray();

		$result = explode(",", $getRes['responsibility_ff']);

		foreach($result as $key => $r){
			$result[$key] = trim($r);
		}

		if(!in_array($code, $result)){
			echo "<script>window.location.href='".base_url()."'</script>";
		}
	}

	function getFFResponsibility(){ 
        
        $responsibility_id = $_SESSION['responsibility'];
		$builder = new ResponsibilityModel();

		$builder->select('responsibility_ff');
		$builder->where('id',$responsibility_id);
		$result = $builder->get();
		$row = $result->getRow();
		
		if ($row->responsibility_ff==null) {
			$result = null;
            echo "<h1>User's Responsibility for this user not set properly. Contact your Administrator to fix the issue.</h1>";
            echo "<br>";
            echo "<p style='text-align:center'><a href='Logout'>Continue... </a></p>";
            exit;
		}
		foreach($result->getResultArray() as $r){
            $result = $r['responsibility_ff'];
        }

        $result = explode(",", $result);

        foreach($result as $key => $r){
            $result[$key] = trim($r);
        }

        $output = '';

		foreach($this->getFormFunction() as $ff){
			if(!in_array($ff['code'], $result)){
				$output .= "$('.".$ff['code']."').css('display', 'none');";
			}
		}


        return $output;
     }
     
     function getFormFunction(){
		$builder = new ModulesModel();
		$result = $builder->get()->getResultArray();
		return $result;
    }

}
