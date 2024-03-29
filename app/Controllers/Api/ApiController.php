<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EmployeeModel;
class ApiController extends ResourceController
{
    public function addEmployee()
    {
        $rules = [
            "name" => "required",
            "email" => "required|valid_email|is_unique[employees.email]|min_length[6]",
            "phone_no" => "required",
        ];

        $messages = [
            "name" => [
                "required" => "Name is required"
            ],
            "email" => [
                "required" => "Email required",
                "valid_email" => "Email address is not in format",
                "is_unique" => "Email address already exists"
            ],
            "phone_no" => [
                "required" => "Phone Number is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];
        } else {

            $emp = new EmployeeModel();

            $data['name'] = $this->request->getVar("name");
            $data['email'] = $this->request->getVar("email");
            $data['phone_no'] = $this->request->getVar("phone_no");

            $emp->save($data);

            $response = [
                'status' => 200,
                'error' => false,
                'message' => 'Employee added successfully',
                'data' => []
            ];
        }

        return $this->respondCreated($response);
    }

    public function listEmployee()
    {
        $emp = new EmployeeModel();

        $response = [
            'status' => 200,
            "error" => false,
            'messages' => 'Employee list',
            'data' => $emp->findAll()
        ];

        return $this->respondCreated($response);
    }
  
}
