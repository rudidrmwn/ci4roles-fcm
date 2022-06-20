<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TaskModel;
use App\Models\UserModel;

class ApprovalController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "approval") {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {

        $model = new TaskModel();
        $data['tasks']  = $model->getTasks()->getResult();

        //check user fcm
        if(isset($_COOKIE['fcmToken'])){
            self::updateUserFcm($_COOKIE['fcmToken'], session()->get('id'));
        }
        
        return view("approval/dashboard",$data);
    }

    public function updateUserFcm($token,$idUser){
        $model = new UserModel();
        $data = array(
            'fcm_token'        => $token
        );
        
        $model->changeUserFcm($data, $idUser);
    }

    public function notification()
    {
        $model = new TaskModel();
        $data= $model->where('status', 'checked')->findAll();

        return json_encode($data);
    }

    public function update()
    {
        $model = new TaskModel();
        $id = $this->request->getPost('id_task');
        $data = array(
            'status'  => 'approved'
        );
        
        $model->updateTask($data, $id);

        //sendFCM
        $to=$this->request->getPost('token');
        $title=$this->request->getPost('task_title');
        $task_description=$this->request->getPost('task_description');
        sendPushNotification($title,$task_description,$to);
        
        return redirect()->to('/approval');
    }
}
