<?php

namespace App\Controllers\Users;
use App\Models\User\UserModel;
use App\Models\User\ResponsibilityModel;
use App\Models\User\ModulesModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use App\Controllers\BaseController;

class UserController extends BaseController
{

	public function index()
	{
		$view = "User/UserView";
        $layout = $this->Layout($view,null);
	}

	public function register()
    {
        $rules = [
            'iis_employee_number' => 'required|is_unique[user.iis_employee_number]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]|max_length[255]',
            'responsibility' => 'required'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $userModel = new UserModel();
        $userModel->save($input);
		$id = $userModel->insertID;
		if($id<>null){
			$email = $_POST['email'];
		}
       	return $this
			->getResponse(
				[
					'message' => 'added successfully',
					'email' => $email
				]
			);
    }

	public function getUser(){
		$response = array();
		## Read value
		$postData = $this->getRequestInput($this->request);

		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		$builder = new UserModel();
		$searchQuery = "";

		if($searchValue != ''){
			$searchQuery = " (email like '%".$searchValue."%' or 
				  iis_employee_number like '%".$searchValue."%') ";
		}

		$count_no_filter = $builder->countAll();
		$totalRecords = $count_no_filter;

	
		if($searchQuery != ''){
			$builder->where($searchQuery);
		}
		$count_with_filter = $builder->countAll();
		$totalRecordwithFilter = $count_with_filter;
		
		$data = array();
		

		if($searchQuery != ''){
			$builder->where($searchQuery);
		}

		$builder->orderBy($columnName, $columnSortOrder);
		$builder->limit($rowperpage,$start);
		$getUser = $builder->get();

		foreach ($getUser->getResult() as $row)
		{
			$data[] = array( 
				"id"=>$row->id,
				"email"=>$row->email,
				"iis_employee_number"=>$row->iis_employee_number,
				"responsibility"=>$row->responsibility
			); 
		}

		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return json_encode($response); 
	}

	public function update(){
		try {

            $model = new UserModel();
           

            $input = $this->getRequestInput($this->request);
			$model->getUserById($input['id']);

            $model->update($input['id'], $input);

            $User = $model->getUserById($input['id']);

            return $this->getResponse(
                [
                    'Users' =>  $User,
					'message' =>  "Updated Successfully"
                ]
            );

        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
	}
	
	public function delete(){
		try {

            $model = new UserModel();
			$input = $this->getRequestInput($this->request);
            $user = $model->getUserById($input['id']);
            $model->delete($user);

            return $this
                ->getResponse(
                    [
						'message' =>  $user['email']." Deleted Successfully"
                    ]
                );

        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
	}

	public function responsibility(){
		$builder = new ModulesModel();

		$builder->like('code', '1U');
		$data['userLinks'] = $builder->get()->getResultArray();

		$view = "User/ResponsibilityView";
        $layout = $this->Layout($view,$data);
	}

	public function getResponsibility(){
		$response = array();
		## Read value
		$postData = $this->getRequestInput($this->request);

		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		$builder = new ResponsibilityModel();
		$searchQuery = "";

		if($searchValue != ''){
			$searchQuery = " (responsibility_name like '%".$searchValue."%') ";
		}

		$count_no_filter = $builder->countAll();
		$totalRecords = $count_no_filter;

	
		if($searchQuery != ''){
			$builder->where($searchQuery);
		}
		$count_with_filter = $builder->countAll();
		$totalRecordwithFilter = $count_with_filter;
		
		$data = array();
		

		if($searchQuery != ''){
			$builder->where($searchQuery);
		}

		$builder->orderBy($columnName, $columnSortOrder);
		$builder->limit($rowperpage,$start);
		$getRes = $builder->get();

		foreach ($getRes->getResult() as $row)
		{
			$data[] = array( 
				"id"=>$row->id,
				"responsibility_name"=>$row->responsibility_name,
				"responsibility_ff"=>$row->responsibility_ff
			); 
		}

		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return json_encode($response); 
	}

	public function insertResponsibility(){
		
		$rules = [
            'responsibility_name' => 'required|is_unique[responsibility.responsibility_name]',
            'responsibility_ff' => 'required'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $resModel = new ResponsibilityModel();
        $resModel->save($input);

		$id = $resModel->insertID;

		if($id<>null){
			$responsibility =  $input['responsibility_name'];
		}

       	return $this
			->getResponse(
				[
					'message' => 'added successfully',
					'res' => $responsibility
				]
			);
	}
}
