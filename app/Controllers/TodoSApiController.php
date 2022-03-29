<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TodoModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class TodoSApiController extends ResourceController
{
     public function __construct()
     {
        $this->todoModel = new TodoModel();
     }
    use ResponseTrait;
    public function index($id=null)
    {  

        $todoModel = new TodoModel();
        
        $data = $todoModel->find($id);
        if(!empty($data)){
            $response =
            [
                  'Message' => 'Single Title',
                  'data' => $data
            ];
        }else{
            $response =[
                 'Message' =>'No Title Found',
            ];
        }
        return $this->respondCreated($response);
       
            //   return $this->respond($this->todoModel->find($id));             
    }

    public function view_All()
    {
        $todoModel = new TodoModel();
     $response =[
         'Message' => 'All Data Of Title',
         $data = $todoModel->findAll()

     ];
     return $this->respondCreated($response);

    }

    public function Insert()
    {
        // $data =$this->request->getPost();
        // $data =[
        //     'title' => $this->request->getPost('title'),
        // ];
        $rules =[
                'title' => "required",
        ];
        $message =[
             "title" =>[
               "required" =>"Title is Required"
             ],
        ];
        if(!$this -> validate($rules,$message)){
            $response =[
           
            'message' => $this->validator->getError(),
         

            ];
        }else{
            $todoModel = new TodoModel();
            $data['title'] =$this->request->getVar("title");
            $todoModel->save($data);
            $response =[
            
                'message' => 'Title is Successfully Added',
             
            ];
        }
        // return $this->respond($this->todoModel->insert($data)); 
        return $this->respondCreated($response);
    }
    

    public function Update($id=null){

        $rules =[
              "title" => "required",
        ];
        $message =[
            "title" => [
               "required" =>"Title Is Required"
            ],
        ];
        // var_dump($this->request->getJSON());
        // die;
        if(!$this->validate($rules,$message)){
            $response =[
           'message' =>$this->validator->getError(),
            ];
        }else{
            $todoModel = new TodoModel();
             if($todoModel->find($id)){
                 $data['title'] =$this->request->getVar("title");

                 $todoModel->update($id,$data);
                 $response =[
                     'Message' => 'Title Successfully Update',
                 ];
             }else{
                 $response =[
                     'message' => 'No Title Found',
                 ];
             }
        }
       return $this->respondCreated($response);
        // $data =$this->request->getJSON();
        // if(!$data = $this->todoModel->update($id,$data)){
        //     return $this->fail('Record Not Sucessfully Update');
        // }
        // return $this->respondUpdated($data, 200 , 'Record Update Successfully!');
        // var_dump($data);
        // die;
    }
    public function Delete($id=null)
    {
        $todoModel = new TodoModel();
     if(!empty($data)){
          $todoModel->delete($id);
          $response =[
              'message' =>'Title Delete SuccessFully',
          ];
     }else{
         $response =[
             'message' => 'No Title Found',
         ];
     }
     return $this->respondCreated($response);
        // return $this->respond($this->todoModel->delete($id)); 
    }
}
