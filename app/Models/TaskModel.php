<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id_task';
    protected $allowedFields    = [
        "task_title",
        "task_description",
        "status"
    ];


    public function getTasks()
    {
        $builder = $this->db->table('tasks');
        return $builder->get();
    }

    public function saveTask($data){
        $query = $this->db->table('tasks')->insert($data);
        return $query;
    }

    public function updateTask($data, $id)
    {
        $query = $this->db->table('tasks')->update($data, array('id_task' => $id));
        return $query;
    }

     public function deleteTask($id)
    {
        $query = $this->db->table('tasks')->delete(array('id_task' => $id));
        return $query;
    } 
 
}