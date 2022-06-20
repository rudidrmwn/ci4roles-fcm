<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TaskModel;
use App\Models\UserModel;

class MakerController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "maker") {
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

        return view("maker/dashboard",$data);
    }

    public function updateUserFcm($token,$idUser){
        $model = new UserModel();
        $data = array(
            'fcm_token'        => $token
        );
        
        $model->changeUserFcm($data, $idUser);
    }

    public function getToChecker(){
        $model = new UserModel();
        $dataUserFcm = $model->where('role', 'checker')->findColumn('fcm_token');
        return $dataUserFcm;
    }

    public function save(){
        $model = new TaskModel();
        $data = array(
            'task_title'        => $this->request->getPost('task_title'),
            'task_description'  => $this->request->getPost('task_description'),
        );
        $model->saveTask($data);
        // $to=$this->request->getPost('token');
        // get token user checker
        $arrFcmToken = self::getToChecker();
        foreach ($arrFcmToken as $value) {
            $to=$value;
            $title=$this->request->getPost('task_title');
            $task_description=$this->request->getPost('task_description');
            sendPushNotification($title,$task_description,$to);
        }

        return redirect()->to('/maker');
    }



    public function update()
    {
        $model = new TaskModel();
        $id = $this->request->getPost('id_task');
        $data = array(
            'task_title'        => $this->request->getPost('task_title'),
            'task_description'  => $this->request->getPost('task_description')
        );
        
        $model->updateTask($data, $id);
        return redirect()->to('/maker');
    }

    public function delete()
    {
        $model = new TaskModel();
        $id = $this->request->getPost('id_task');
        $model->deleteTask($id);
        return redirect()->to('/maker');
    }

    
}
