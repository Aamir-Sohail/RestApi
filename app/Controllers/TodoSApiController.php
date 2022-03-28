<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TodoModel;
use CodeIgniter\API\ResponseTrait;

class TodoSApiController extends BaseController
{
     public function __construct()
     {
        $this->todoModel = new TodoModel();
     }
    use ResponseTrait;
    public function index($id=null)
    {  

       
              return $this->respond($this->todoModel->find($id));             
     
    }
    public function Insert()
    {
        $data =$this->request->getPost();
        return $this->respond($this->todoModel->insert($data)); 
    }
    

    public function Update($id){
       
        $data =$this->request->getJSON();
        if(!$data = $this->todoModel->update($id,$data)){
            return $this->fail('Record Not Sucessfully Update');
        }
        return $this->respondUpdated($data, 200 , 'Record Update Successfully!');
        // var_dump($data);
        // die;
    }
}
